Imports System.Windows.Forms
Imports Microsoft.Office.Tools.Ribbon
Imports MySql.Data.MySqlClient


Public Class Login_Form
    Dim conn As New MySqlConnection
    Dim uID, userName As String

    Private Sub form_load() Handles MyBase.Load
        'Set up the mySQL table connection info
        Dim databaseName As String = "nell"
        Dim server As String = "localhost"
        Dim userName As String = "root"
        Dim passWord As String = ""
        If Not conn Is Nothing Then conn.Close()
        conn.ConnectionString = String.Format("server={0}; user id={1}; password={2}; database={3}; pooling=false", server, userName, passWord, databaseName)

        If Not Globals.ThisAddIn.userInfo(0) = "" Then
            'hides login fields if logged in
            userNameField.Enabled = False
            userNameField.Visible = False
            passWordField.Enabled = False
            passWordField.Visible = False
            LoginBTN.Enabled = False
            LoginBTN.Visible = False
            uNameLbl.Visible = False
            passLbl.Visible = False

            'Welcome user, and offer log out option
            welcomeLbl.Text = "Welcome, " + Globals.ThisAddIn.userInfo(2)
            welcomeLbl.Visible = True
            LogoutBtn.Enabled = True
            LogoutBtn.Visible = True

        End If

    End Sub

    Private Sub LoginBTN_Click(sender As Object, e As EventArgs) Handles LoginBTN.Click
        'Checks user has entered there details
        If userNameField.Text = "" Then
            MessageBox.Show("Please enter a valid user name")
        ElseIf passWordField.Text = "" Then
            MessageBox.Show("Please enter a valid password")
        Else
            userName = userNameField.Text
            'Open Connection to  Database and check user info
            Try
                conn.Open()
                Dim cmd As New MySqlCommand("SELECT * FROM lecturers WHERE username='" + userNameField.Text + "' AND password='" + passWordField.Text + "'")
                cmd.Connection = conn
                Dim dbread As MySqlDataReader = cmd.ExecuteReader()

                'Store current user info
                While dbread.Read
                    Globals.ThisAddIn.userInfo(0) = dbread("lecturer_id")
                    Globals.ThisAddIn.userInfo(1) = dbread("username")
                    Globals.ThisAddIn.userInfo(2) = dbread("first_name")
                    Globals.ThisAddIn.userInfo(3) = dbread("last_name")
                End While
                dbread.Close()

                'Get users modules and add them to dropdown
                cmd = New MySqlCommand("SELECT * FROM modules WHERE lecturer_id='" + Globals.ThisAddIn.userInfo(0) + "'")
                cmd.Connection = conn
                dbread = cmd.ExecuteReader()

                Dim rdi As RibbonDropDownItem
                While dbread.Read
                    rdi = Globals.Factory.GetRibbonFactory().CreateRibbonDropDownItem()
                    rdi.Label = dbread("mod_code")
                    Globals.Ribbons.Ribbon1.DropDownModule.Items.Add(rdi)
                End While

                dbread.Close()
                conn.Close()
            Catch ex As Exception
                MsgBox(ex.Message)
                Globals.ThisAddIn.userInfo(0) = ""
            End Try

            If Globals.ThisAddIn.userInfo(0) = "" Then
                MessageBox.Show("Login failed")
            Else

                MessageBox.Show("Logged In")
                'enable buttons
                Globals.Ribbons.Ribbon1.DropDownModule.Enabled = True
                Globals.Ribbons.Ribbon1.QueAnchorBtn.Enabled = True
                Globals.Ribbons.Ribbon1.TermAnchorBtn.Enabled = True
                Me.Close()

            End If
        End If
    End Sub

    Private Sub LogoutBtn_Click(sender As Object, e As EventArgs) Handles LogoutBtn.Click
        'clear user data
        For index = 0 To 3
            Globals.ThisAddIn.userInfo(index) = ""
        Next

        welcomeLbl.Text = ""
        welcomeLbl.Visible = False
        LogoutBtn.Enabled = False
        LogoutBtn.Visible = False

        'Make login visible again
        userNameField.Enabled = True
        userNameField.Visible = True
        passWordField.Enabled = True
        passWordField.Visible = True
        LoginBTN.Enabled = True
        LoginBTN.Visible = True
        uNameLbl.Visible = True
        passLbl.Visible = True

        'disable buttons
        Globals.Ribbons.Ribbon1.DropDownModule.Enabled = False
        Globals.Ribbons.Ribbon1.QueAnchorBtn.Enabled = False
        Globals.Ribbons.Ribbon1.TermAnchorBtn.Enabled = False
        'Clears module list
        Globals.Ribbons.Ribbon1.DropDownModule.Items.Clear()

    End Sub
End Class
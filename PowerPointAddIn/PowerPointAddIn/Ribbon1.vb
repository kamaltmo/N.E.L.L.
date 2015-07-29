Imports Microsoft.Office.Tools.Ribbon
Imports MySql.Data.MySqlClient
Imports PowerPoint = Microsoft.Office.Interop.PowerPoint

Public Class Ribbon1
    Dim conn As New MySqlConnection
    Dim sldId As Integer


    Private Sub Ribbon1_Load(ByVal sender As System.Object, ByVal e As RibbonUIEventArgs) Handles MyBase.Load
        'Set up the mySQL table connection info
        Dim databaseName As String = "addintest"
        Dim server As String = "localhost"
        Dim userName As String = "root"
        Dim passWord As String = ""
        If Not conn Is Nothing Then conn.Close()
        conn.ConnectionString = String.Format("server={0}; user id={1}; password={2}; database={3}; pooling=false", server, userName, passWord, databaseName)

    End Sub
    Private Sub LoginBtn_Click(sender As Object, e As RibbonControlEventArgs) Handles LoginBtn.Click
        Dim loginForm As New Login_Form
        loginForm.Show()
        'Dim webB As Windows.Forms.WebBrowser = loginForm.WebBrowser1
        'webB.Refresh()
    End Sub

    Private Sub QueAnchorBtn_Click(sender As Object, e As RibbonControlEventArgs) Handles QueAnchorBtn.Click

        Dim queSelect As New Question_form
        queSelect.Show()

    End Sub

    Private Sub TermAnchorBtn_Click(sender As Object, e As RibbonControlEventArgs) Handles TermAnchorBtn.Click
        Dim termSelect As New Glossary_form
        termSelect.Show()
    End Sub
End Class

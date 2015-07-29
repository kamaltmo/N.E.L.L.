Imports MySql.Data.MySqlClient
Public Class Question_form

    Private Sub form_load() Handles MyBase.Load
        Dim conn As New MySqlConnection

        'Set up the mySQL table connection info
        Dim databaseName As String = Globals.Ribbons.Ribbon1.DropDownModule.SelectedItem.Label
        Dim server As String = "localhost"
        Dim userName As String = "root"
        Dim passWord As String = ""
        Dim queInfo As String

        If Not conn Is Nothing Then conn.Close()
        conn.ConnectionString = String.Format("server={0}; user id={1}; password={2}; database={3}; pooling=false", server, userName, passWord, databaseName)

        If Not databaseName = "" Then
            'Open Connection to  Database and check user info
            Try
                conn.Open()
                Dim cmd As New MySqlCommand("SELECT question_id, question FROM multi_questions")
                cmd.Connection = conn
                Dim dbread As MySqlDataReader = cmd.ExecuteReader()

                'Store current user info
                While dbread.Read
                    queInfo = dbread("question_id") & " - " & dbread("question")
                    QuestionCheckList.Items.Add(queInfo)
                End While

                dbread.Close()
                conn.Close()
            Catch ex As Exception
                MsgBox(ex.Message)
                Me.Close()
            End Try
        End If

    End Sub

    Private Sub AnchorBtn_Click(sender As Object, e As EventArgs) Handles AnchorBtn.Click
        Dim pres As PowerPoint.Presentation = Globals.ThisAddIn.Application.ActivePresentation                                      'Selects teh current presentation


        'ERROR HANDLING
        If pres.Slides.Count = 0 Then
            MsgBox("You do not have any slides in your PowerPoint project.")
            Exit Sub
        End If

        Dim Sld As PowerPoint.Slide = Globals.ThisAddIn.Application.ActiveWindow.View.Slide                                         ' Select the active slide
        Dim Shp As PowerPoint.Shape

        'Remove any current question anchor on the page
        For Each Shp In Sld.Shapes
            If Shp.Name.StartsWith("Anchor Q") Then
                Shp.Delete()
            End If
        Next

        'Create shape with Specified Dimensions and Slide Position
        Shp = Sld.Shapes.AddShape(Office.MsoAutoShapeType.msoShapeRoundedRectangle, Left:=10, Top:=10, Width:=20, Height:=20)

        'FORMAT SHAPE
        'Shape Name
        Dim item As Object

        'Basic anchor info, module and Type
        Dim info As String
        info = "Anchor Q " & Globals.Ribbons.Ribbon1.DropDownModule.SelectedItem.Label
        Shp.Name = info

        For Each item In QuestionCheckList.CheckedItems
            Shp.Name = Shp.Name & " " & item.ToString.Substring(0, item.ToString.IndexOf(" "))
        Next

        'No Shape Border
        Shp.Line.Visible = Microsoft.Office.Core.MsoTriState.msoFalse

        'Shape Fill Color
        Shp.Fill.ForeColor.RGB = RGB(184, 59, 29)

        'Shape Text Color
        Shp.TextFrame.TextRange.Font.Color.RGB = RGB(255, 255, 255)

        'Text inside Shape
        Shp.TextFrame.TextRange.Characters.Text = "Q"

        'Center Align Text
        Shp.TextFrame.TextRange.Paragraphs.ParagraphFormat.Alignment = PowerPoint.PpParagraphAlignment.ppAlignCenter

        'Vertically Align Text to Middle
        Shp.TextFrame2.VerticalAnchor = Microsoft.Office.Core.MsoVerticalAnchor.msoAnchorMiddle

        'Adjust Font Size
        Shp.TextFrame2.TextRange.Font.Size = 14

        'Adjust Font Style
        Shp.TextFrame2.TextRange.Font.Name = "Arial"

        If Shp.Name = info Then
            Shp.Delete()
        End If

    End Sub
End Class
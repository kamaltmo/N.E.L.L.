Imports MySql.Data.MySqlClient
Imports Microsoft.Office.Tools.Ribbon
Imports System.Text.RegularExpressions

Public Class ThisAddIn
    Dim conn As New MySqlConnection
    Dim lastQAnchor() As String
    Dim lastTAnchor() As String
    Dim sldId As Integer
    Public userInfo(4) As String


    Private Sub ThisAddIn_Startup() Handles Me.Startup

        'Inisilize last anchor as nothing
        lastQAnchor = {""}
        lastTAnchor = {""}

    End Sub
    Private Sub Application_changeSlide(ByVal Wn As PowerPoint.SlideShowWindow) Handles Application.SlideShowNextSlide
        Dim Sld As PowerPoint.Slide = Wn.View.Slide                                                                                'Gets the slide when ever the page changes
        Dim shp As PowerPoint.Shape
        Dim info() As String
        Dim server As String = "localhost"
        Dim userName As String = "root"
        Dim passWord As String = ""
        Dim sldId = Sld.GetHashCode()
        Dim pNum As Integer = Sld.SlideNumber
        Dim modul, type As String

        'Check if user is logged in
        If Not userInfo(0) = "" Then

            'Check if a previous slide has set questions active
            'If so, deactivate them
            If lastQAnchor(0) = "Anchor" Then
                type = lastQAnchor(1)
                modul = lastQAnchor(2)

                'set database to module
                Dim databaseName As String = modul

                conn.ConnectionString = String.Format("server={0}; user id={1}; password={2}; database={3}; pooling=false", server, userName, passWord, databaseName)

                'For every question/ term set active to 0
                For index = 3 To (lastQAnchor.Length - 1)
                    Try
                        conn.Open()
                        Dim cmd As New MySqlCommand
                        If (type = "Q") Then
                            cmd = New MySqlCommand("UPDATE multi_questions SET active='0' WHERE question_id='" & lastQAnchor(index) & "'")
                        Else
                            cmd = New MySqlCommand("UPDATE glossary SET active='0' WHERE term_id='" & lastQAnchor(index) & "'")
                        End If

                        cmd.Connection = conn
                        cmd.ExecuteNonQuery()
                        conn.Close()
                    Catch ex As Exception
                        MsgBox(ex.Message)
                    End Try
                Next

                'Set past anchor to nothing
                lastQAnchor = {""}
            End If

            'Check if a previous slide has set terms active
            'If so, deactivate them
            If lastTAnchor(0) = "Anchor" Then
                type = lastTAnchor(1)
                modul = lastTAnchor(2)

                'set database to module
                Dim databaseName As String = modul

                conn.ConnectionString = String.Format("server={0}; user id={1}; password={2}; database={3}; pooling=false", server, userName, passWord, databaseName)

                'For every question/ term set active to 0
                For index = 3 To (lastTAnchor.Length - 1)
                    Try
                        conn.Open()
                        Dim cmd As New MySqlCommand
                        If (type = "Q") Then
                            cmd = New MySqlCommand("UPDATE multi_questions SET active='0' WHERE question_id='" & lastTAnchor(index) & "'")
                        Else
                            cmd = New MySqlCommand("UPDATE glossary SET active='0' WHERE term_id='" & lastTAnchor(index) & "'")
                        End If

                        cmd.Connection = conn
                        cmd.ExecuteNonQuery()
                        conn.Close()
                    Catch ex As Exception
                        MsgBox(ex.Message)
                    End Try
                Next

                'Set past anchor to nothing
                lastTAnchor = {""}
            End If

            'Search everyshape on a slide
            For Each shp In Sld.Shapes

                'split info into array
                info = shp.Name.Split(" ")

                'Check if any shape on this page is anchor
                If info(0) = "Anchor" Then

                    type = info(1)
                    modul = info(2)

                    'set database to module
                    Dim databaseName As String = modul

                    conn.ConnectionString = String.Format("server={0}; user id={1}; password={2}; database={3}; pooling=false", server, userName, passWord, databaseName)

                    'For every question/ term set active to 1
                    For index = 3 To (info.Length - 1)
                        Try
                            conn.Open()
                            Dim cmd As New MySqlCommand
                            If (type = "Q") Then
                                cmd = New MySqlCommand("UPDATE multi_questions SET active='1' WHERE question_id='" & info(index) & "'")
                            Else
                                cmd = New MySqlCommand("UPDATE glossary SET active='1' WHERE term_id='" & info(index) & "'")
                            End If

                            cmd.Connection = conn
                            cmd.ExecuteNonQuery()
                            conn.Close()
                        Catch ex As Exception
                            MsgBox(ex.Message)
                        End Try
                    Next

                    'set past anchor
                    If type = "Q" Then
                        lastQAnchor = info
                    Else
                        lastTAnchor = info
                    End If
                End If

            Next
        End If
    End Sub
End Class

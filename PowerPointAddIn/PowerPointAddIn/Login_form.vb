Imports Microsoft.Win32

Public Class LoginForm

    Private Sub Form1_Load(sender As Object, e As EventArgs) Handles MyBase.Load
        WebBrowser1.Url = New System.Uri("http://localhost/nell/pp_login.php")
    End Sub

    Private Sub WebBrowser1_DocumentCompleted(sender As Object, e As Windows.Forms.WebBrowserDocumentCompletedEventArgs) Handles WebBrowser1.DocumentCompleted
        WebBrowser1.ScrollBarsEnabled = False
    End Sub

    Private Sub Form1_Close() Handles MyBase.Deactivate

    End Sub
End Class
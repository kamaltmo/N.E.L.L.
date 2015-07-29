<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Login_Form
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Login_Form))
        Me.userNameField = New System.Windows.Forms.TextBox()
        Me.uNameLbl = New System.Windows.Forms.Label()
        Me.LoginBTN = New System.Windows.Forms.Button()
        Me.passLbl = New System.Windows.Forms.Label()
        Me.passWordField = New System.Windows.Forms.TextBox()
        Me.LogoutBtn = New System.Windows.Forms.Button()
        Me.welcomeLbl = New System.Windows.Forms.Label()
        Me.SuspendLayout()
        '
        'userNameField
        '
        Me.userNameField.BackColor = System.Drawing.SystemColors.ButtonHighlight
        Me.userNameField.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle
        Me.userNameField.Font = New System.Drawing.Font("Century Gothic", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.userNameField.ForeColor = System.Drawing.SystemColors.WindowFrame
        Me.userNameField.Location = New System.Drawing.Point(11, 91)
        Me.userNameField.Margin = New System.Windows.Forms.Padding(2)
        Me.userNameField.Name = "userNameField"
        Me.userNameField.Size = New System.Drawing.Size(241, 27)
        Me.userNameField.TabIndex = 0
        '
        'uNameLbl
        '
        Me.uNameLbl.AutoSize = True
        Me.uNameLbl.BackColor = System.Drawing.Color.Transparent
        Me.uNameLbl.Font = New System.Drawing.Font("Century Gothic", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.uNameLbl.ForeColor = System.Drawing.Color.AliceBlue
        Me.uNameLbl.Location = New System.Drawing.Point(8, 66)
        Me.uNameLbl.Margin = New System.Windows.Forms.Padding(2, 0, 2, 0)
        Me.uNameLbl.Name = "uNameLbl"
        Me.uNameLbl.RightToLeft = System.Windows.Forms.RightToLeft.Yes
        Me.uNameLbl.Size = New System.Drawing.Size(88, 21)
        Me.uNameLbl.TabIndex = 1
        Me.uNameLbl.Text = "Username"
        '
        'LoginBTN
        '
        Me.LoginBTN.BackColor = System.Drawing.SystemColors.ButtonFace
        Me.LoginBTN.FlatAppearance.BorderColor = System.Drawing.Color.FromArgb(CType(CType(224, Byte), Integer), CType(CType(224, Byte), Integer), CType(CType(224, Byte), Integer))
        Me.LoginBTN.FlatAppearance.MouseDownBackColor = System.Drawing.Color.RoyalBlue
        Me.LoginBTN.FlatAppearance.MouseOverBackColor = System.Drawing.Color.LightSteelBlue
        Me.LoginBTN.FlatStyle = System.Windows.Forms.FlatStyle.System
        Me.LoginBTN.Font = New System.Drawing.Font("Century Gothic", 15.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.LoginBTN.Location = New System.Drawing.Point(11, 229)
        Me.LoginBTN.Margin = New System.Windows.Forms.Padding(2)
        Me.LoginBTN.Name = "LoginBTN"
        Me.LoginBTN.Size = New System.Drawing.Size(241, 38)
        Me.LoginBTN.TabIndex = 2
        Me.LoginBTN.Text = "Log In"
        Me.LoginBTN.UseVisualStyleBackColor = False
        '
        'passLbl
        '
        Me.passLbl.AutoSize = True
        Me.passLbl.BackColor = System.Drawing.Color.Transparent
        Me.passLbl.Font = New System.Drawing.Font("Century Gothic", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.passLbl.ForeColor = System.Drawing.Color.AliceBlue
        Me.passLbl.Location = New System.Drawing.Point(7, 138)
        Me.passLbl.Margin = New System.Windows.Forms.Padding(2, 0, 2, 0)
        Me.passLbl.Name = "passLbl"
        Me.passLbl.Size = New System.Drawing.Size(82, 21)
        Me.passLbl.TabIndex = 4
        Me.passLbl.Text = "Password"
        '
        'passWordField
        '
        Me.passWordField.Font = New System.Drawing.Font("Century Gothic", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.passWordField.ForeColor = System.Drawing.SystemColors.WindowFrame
        Me.passWordField.Location = New System.Drawing.Point(11, 163)
        Me.passWordField.Margin = New System.Windows.Forms.Padding(2)
        Me.passWordField.Name = "passWordField"
        Me.passWordField.PasswordChar = Global.Microsoft.VisualBasic.ChrW(42)
        Me.passWordField.Size = New System.Drawing.Size(241, 27)
        Me.passWordField.TabIndex = 3
        '
        'LogoutBtn
        '
        Me.LogoutBtn.BackColor = System.Drawing.Color.CornflowerBlue
        Me.LogoutBtn.Enabled = False
        Me.LogoutBtn.FlatAppearance.BorderColor = System.Drawing.Color.FromArgb(CType(CType(224, Byte), Integer), CType(CType(224, Byte), Integer), CType(CType(224, Byte), Integer))
        Me.LogoutBtn.FlatAppearance.MouseDownBackColor = System.Drawing.Color.RoyalBlue
        Me.LogoutBtn.FlatAppearance.MouseOverBackColor = System.Drawing.Color.LightSteelBlue
        Me.LogoutBtn.FlatStyle = System.Windows.Forms.FlatStyle.System
        Me.LogoutBtn.Font = New System.Drawing.Font("Century Gothic", 15.75!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.LogoutBtn.Location = New System.Drawing.Point(11, 172)
        Me.LogoutBtn.Margin = New System.Windows.Forms.Padding(2)
        Me.LogoutBtn.Name = "LogoutBtn"
        Me.LogoutBtn.Size = New System.Drawing.Size(241, 38)
        Me.LogoutBtn.TabIndex = 5
        Me.LogoutBtn.Text = "Log Out"
        Me.LogoutBtn.UseVisualStyleBackColor = False
        Me.LogoutBtn.Visible = False
        '
        'welcomeLbl
        '
        Me.welcomeLbl.AutoSize = True
        Me.welcomeLbl.BackColor = System.Drawing.Color.Transparent
        Me.welcomeLbl.Cursor = System.Windows.Forms.Cursors.Default
        Me.welcomeLbl.Font = New System.Drawing.Font("Century Gothic", 14.25!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.welcomeLbl.ForeColor = System.Drawing.SystemColors.ButtonHighlight
        Me.welcomeLbl.Location = New System.Drawing.Point(12, 136)
        Me.welcomeLbl.Name = "welcomeLbl"
        Me.welcomeLbl.Size = New System.Drawing.Size(0, 22)
        Me.welcomeLbl.TabIndex = 6
        Me.welcomeLbl.TextAlign = System.Drawing.ContentAlignment.MiddleCenter
        Me.welcomeLbl.Visible = False
        '
        'Login_Form
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackColor = System.Drawing.SystemColors.ActiveBorder
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(264, 332)
        Me.Controls.Add(Me.welcomeLbl)
        Me.Controls.Add(Me.LogoutBtn)
        Me.Controls.Add(Me.passLbl)
        Me.Controls.Add(Me.passWordField)
        Me.Controls.Add(Me.LoginBTN)
        Me.Controls.Add(Me.uNameLbl)
        Me.Controls.Add(Me.userNameField)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.Margin = New System.Windows.Forms.Padding(2)
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "Login_Form"
        Me.ShowIcon = False
        Me.Text = "Login"
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents userNameField As System.Windows.Forms.TextBox
    Friend WithEvents uNameLbl As System.Windows.Forms.Label
    Friend WithEvents LoginBTN As System.Windows.Forms.Button
    Friend WithEvents passLbl As System.Windows.Forms.Label
    Friend WithEvents passWordField As System.Windows.Forms.TextBox
    Friend WithEvents LogoutBtn As System.Windows.Forms.Button
    Friend WithEvents welcomeLbl As System.Windows.Forms.Label
End Class

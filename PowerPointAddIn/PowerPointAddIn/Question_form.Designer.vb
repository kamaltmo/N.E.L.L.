<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Question_form
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Question_form))
        Me.QuestionCheckList = New System.Windows.Forms.CheckedListBox()
        Me.AnchorBtn = New System.Windows.Forms.Button()
        Me.SuspendLayout()
        '
        'QuestionCheckList
        '
        Me.QuestionCheckList.BackColor = System.Drawing.SystemColors.Window
        Me.QuestionCheckList.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.QuestionCheckList.Font = New System.Drawing.Font("Century Gothic", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.QuestionCheckList.ForeColor = System.Drawing.SystemColors.MenuHighlight
        Me.QuestionCheckList.FormattingEnabled = True
        Me.QuestionCheckList.HorizontalScrollbar = True
        Me.QuestionCheckList.Location = New System.Drawing.Point(32, 102)
        Me.QuestionCheckList.Name = "QuestionCheckList"
        Me.QuestionCheckList.Size = New System.Drawing.Size(588, 352)
        Me.QuestionCheckList.TabIndex = 0
        Me.QuestionCheckList.ThreeDCheckBoxes = True
        '
        'AnchorBtn
        '
        Me.AnchorBtn.Location = New System.Drawing.Point(527, 10)
        Me.AnchorBtn.Name = "AnchorBtn"
        Me.AnchorBtn.Size = New System.Drawing.Size(93, 52)
        Me.AnchorBtn.TabIndex = 1
        Me.AnchorBtn.Text = "Make Anchor"
        Me.AnchorBtn.UseVisualStyleBackColor = True
        '
        'Question_form
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(654, 494)
        Me.Controls.Add(Me.AnchorBtn)
        Me.Controls.Add(Me.QuestionCheckList)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "Question_form"
        Me.ShowIcon = False
        Me.Text = "Select Questions"
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents QuestionCheckList As System.Windows.Forms.CheckedListBox
    Friend WithEvents AnchorBtn As System.Windows.Forms.Button
End Class

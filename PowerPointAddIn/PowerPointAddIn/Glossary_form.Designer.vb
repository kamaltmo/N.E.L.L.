<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Glossary_form
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
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Glossary_form))
        Me.GlosAnchorBtn = New System.Windows.Forms.Button()
        Me.GlossaryCheckList = New System.Windows.Forms.CheckedListBox()
        Me.SuspendLayout()
        '
        'GlosAnchorBtn
        '
        Me.GlosAnchorBtn.Location = New System.Drawing.Point(528, 9)
        Me.GlosAnchorBtn.Name = "GlosAnchorBtn"
        Me.GlosAnchorBtn.Size = New System.Drawing.Size(93, 52)
        Me.GlosAnchorBtn.TabIndex = 3
        Me.GlosAnchorBtn.Text = "Make Anchor"
        Me.GlosAnchorBtn.UseVisualStyleBackColor = True
        '
        'GlossaryCheckList
        '
        Me.GlossaryCheckList.BackColor = System.Drawing.SystemColors.Window
        Me.GlossaryCheckList.BorderStyle = System.Windows.Forms.BorderStyle.None
        Me.GlossaryCheckList.Font = New System.Drawing.Font("Century Gothic", 12.0!, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, CType(0, Byte))
        Me.GlossaryCheckList.ForeColor = System.Drawing.SystemColors.MenuHighlight
        Me.GlossaryCheckList.FormattingEnabled = True
        Me.GlossaryCheckList.HorizontalScrollbar = True
        Me.GlossaryCheckList.Location = New System.Drawing.Point(33, 101)
        Me.GlossaryCheckList.Name = "GlossaryCheckList"
        Me.GlossaryCheckList.Size = New System.Drawing.Size(588, 352)
        Me.GlossaryCheckList.TabIndex = 2
        Me.GlossaryCheckList.ThreeDCheckBoxes = True
        '
        'Glossary_form
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.BackgroundImage = CType(resources.GetObject("$this.BackgroundImage"), System.Drawing.Image)
        Me.BackgroundImageLayout = System.Windows.Forms.ImageLayout.Stretch
        Me.ClientSize = New System.Drawing.Size(654, 494)
        Me.Controls.Add(Me.GlosAnchorBtn)
        Me.Controls.Add(Me.GlossaryCheckList)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "Glossary_form"
        Me.Text = "Glossary Select"
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents GlosAnchorBtn As System.Windows.Forms.Button
    Friend WithEvents GlossaryCheckList As System.Windows.Forms.CheckedListBox
End Class

Partial Class Ribbon1
    Inherits Microsoft.Office.Tools.Ribbon.RibbonBase

    <System.Diagnostics.DebuggerNonUserCode()> _
   Public Sub New(ByVal container As System.ComponentModel.IContainer)
        MyClass.New()

        'Required for Windows.Forms Class Composition Designer support
        If (container IsNot Nothing) Then
            container.Add(Me)
        End If

    End Sub

    <System.Diagnostics.DebuggerNonUserCode()> _
    Public Sub New()
        MyBase.New(Globals.Factory.GetRibbonFactory())

        'This call is required by the Component Designer.
        InitializeComponent()

    End Sub

    'Component overrides dispose to clean up the component list.
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

    'Required by the Component Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Component Designer
    'It can be modified using the Component Designer.
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Ribbon1))
        Me.Tab1 = Me.Factory.CreateRibbonTab
        Me.NellTab = Me.Factory.CreateRibbonTab
        Me.Group1 = Me.Factory.CreateRibbonGroup
        Me.Group2 = Me.Factory.CreateRibbonGroup
        Me.DropDownModule = Me.Factory.CreateRibbonDropDown
        Me.LoginBtn = Me.Factory.CreateRibbonButton
        Me.QueAnchorBtn = Me.Factory.CreateRibbonButton
        Me.TermAnchorBtn = Me.Factory.CreateRibbonButton
        Me.Tab1.SuspendLayout()
        Me.NellTab.SuspendLayout()
        Me.Group1.SuspendLayout()
        Me.Group2.SuspendLayout()
        '
        'Tab1
        '
        Me.Tab1.ControlId.ControlIdType = Microsoft.Office.Tools.Ribbon.RibbonControlIdType.Office
        Me.Tab1.Label = "TabAddIns"
        Me.Tab1.Name = "Tab1"
        '
        'NellTab
        '
        Me.NellTab.Groups.Add(Me.Group1)
        Me.NellTab.Groups.Add(Me.Group2)
        Me.NellTab.Label = "NELL ADD IN"
        Me.NellTab.Name = "NellTab"
        '
        'Group1
        '
        Me.Group1.Items.Add(Me.LoginBtn)
        Me.Group1.Label = "Login"
        Me.Group1.Name = "Group1"
        '
        'Group2
        '
        Me.Group2.Items.Add(Me.DropDownModule)
        Me.Group2.Items.Add(Me.QueAnchorBtn)
        Me.Group2.Items.Add(Me.TermAnchorBtn)
        Me.Group2.Label = "Identify Page"
        Me.Group2.Name = "Group2"
        '
        'DropDownModule
        '
        Me.DropDownModule.Enabled = False
        Me.DropDownModule.Label = "Select A Module"
        Me.DropDownModule.Name = "DropDownModule"
        '
        'LoginBtn
        '
        Me.LoginBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge
        Me.LoginBtn.Image = CType(resources.GetObject("LoginBtn.Image"), System.Drawing.Image)
        Me.LoginBtn.Label = "Login"
        Me.LoginBtn.Name = "LoginBtn"
        Me.LoginBtn.ShowImage = True
        '
        'QueAnchorBtn
        '
        Me.QueAnchorBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge
        Me.QueAnchorBtn.Enabled = False
        Me.QueAnchorBtn.Image = CType(resources.GetObject("QueAnchorBtn.Image"), System.Drawing.Image)
        Me.QueAnchorBtn.Label = "Make Question Anchor"
        Me.QueAnchorBtn.Name = "QueAnchorBtn"
        Me.QueAnchorBtn.ShowImage = True
        '
        'TermAnchorBtn
        '
        Me.TermAnchorBtn.ControlSize = Microsoft.Office.Core.RibbonControlSize.RibbonControlSizeLarge
        Me.TermAnchorBtn.Enabled = False
        Me.TermAnchorBtn.Image = CType(resources.GetObject("TermAnchorBtn.Image"), System.Drawing.Image)
        Me.TermAnchorBtn.Label = "Make Term Anchor"
        Me.TermAnchorBtn.Name = "TermAnchorBtn"
        Me.TermAnchorBtn.ShowImage = True
        '
        'Ribbon1
        '
        Me.Name = "Ribbon1"
        Me.RibbonType = "Microsoft.PowerPoint.Presentation"
        Me.Tabs.Add(Me.Tab1)
        Me.Tabs.Add(Me.NellTab)
        Me.Tab1.ResumeLayout(False)
        Me.Tab1.PerformLayout()
        Me.NellTab.ResumeLayout(False)
        Me.NellTab.PerformLayout()
        Me.Group1.ResumeLayout(False)
        Me.Group1.PerformLayout()
        Me.Group2.ResumeLayout(False)
        Me.Group2.PerformLayout()

    End Sub

    Friend WithEvents Tab1 As Microsoft.Office.Tools.Ribbon.RibbonTab
    Friend WithEvents NellTab As Microsoft.Office.Tools.Ribbon.RibbonTab
    Friend WithEvents Group1 As Microsoft.Office.Tools.Ribbon.RibbonGroup
    Friend WithEvents LoginBtn As Microsoft.Office.Tools.Ribbon.RibbonButton
    Friend WithEvents Group2 As Microsoft.Office.Tools.Ribbon.RibbonGroup
    Friend WithEvents TermAnchorBtn As Microsoft.Office.Tools.Ribbon.RibbonButton
    Friend WithEvents DropDownModule As Microsoft.Office.Tools.Ribbon.RibbonDropDown
    Friend WithEvents QueAnchorBtn As Microsoft.Office.Tools.Ribbon.RibbonButton
End Class

Partial Class ThisRibbonCollection

    <System.Diagnostics.DebuggerNonUserCode()> _
    Friend ReadOnly Property Ribbon1() As Ribbon1
        Get
            Return Me.GetRibbon(Of Ribbon1)()
        End Get
    End Property
End Class

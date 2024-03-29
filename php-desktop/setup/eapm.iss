; Script generated by the Inno Setup Script Wizard.
; SEE THE DOCUMENTATION FOR DETAILS ON CREATING INNO SETUP SCRIPT FILES!

[Setup]
; NOTE: The value of AppId uniquely identifies this application.
; Do not use the same AppId value in installers for other applications.
; (To generate a new GUID, click Tools | Generate GUID inside the IDE.)
AppId={{C4A68657-181C-4D55-91F7-EE5872F19911}
AppName=EAPM
AppVerName=EAPM V1.0.0
AppPublisher=ShenZhen LingLong Software Lab.
AppPublisherURL=http://www.35vt.com/
AppSupportURL=http://www.35vt.com/
AppUpdatesURL=http://www.35vt.com/
DefaultDirName={pf}\EAPM
DefaultGroupName=EAPM
OutputDir=..\pub
OutputBaseFilename=setup
Compression=lzma
SolidCompression=yes

[Languages]
Name: english; MessagesFile: compiler:Default.isl
Name: chinese; MessagesFile: compiler:Languages\ChineseSimp.isl

[Files]
Source: ..\httpd\*; DestDir: {app}\httpd; Flags: ignoreversion recursesubdirs createallsubdirs; AfterInstall: ChangeString(ExpandConstant('{app}\httpd\conf\httpd.conf'), ExpandConstant('{app}') )
Source: ..\php\*; DestDir: {app}\php; Flags: ignoreversion recursesubdirs createallsubdirs; AfterInstall: ChangeString(ExpandConstant('{app}\php\php.ini'), ExpandConstant('{app}') )
Source: ..\php\php5ts.dll; DestDir: {app}\httpd\bin; Flags: ignoreversion recursesubdirs createallsubdirs; AfterInstall: ChangeString(ExpandConstant('{app}\php\php.ini'), ExpandConstant('{app}') )
Source: ..\db\*; DestDir: {app}\db; Flags: ignoreversion recursesubdirs createallsubdirs
Source: ..\app\*; DestDir: {app}\app; Flags: ignoreversion recursesubdirs createallsubdirs
Source: ..\EAPM.url; DestDir: {app}
; NOTE: Don't use "Flags: ignoreversion" on any shared system files

[Run]
Filename: {app}\httpd\installservice.bat; WorkingDir: {app}\httpd; Flags: runhidden
Filename: {app}\db\installservice.bat; WorkingDir: {app}\db; Flags: runhidden
[UninstallRun]
Filename: {app}\httpd\uninstallservice.bat; WorkingDir: {app}\httpd; Flags: runhidden; Languages: 
Filename: {app}\db\uninstallservice.bat; WorkingDir: {app}\db\; Flags: runhidden
[Code]
procedure ChangeString(FileName: String; RootName: String);

var SrcContent: String;

begin
LoadStringFromFile (FileName, SrcContent);
StringChange (SrcContent, 'D:\www\php_suite\eapm', RootName);
SaveStringToFile(FileName,SrcContent, False);
end;
[Icons]
Name: {group}\EAPM; Filename: {app}\EAPM.url; Languages: 
Name: {group}\{cm:UninstallProgram,EAPM}; Filename: {uninstallexe}
Name: {commondesktop}\EAPM; Filename: {app}\EAPM.url
Name: {userappdata}\Microsoft\Internet Explorer\Quick Launch\EAPM; Filename: {app}\EAPM.url

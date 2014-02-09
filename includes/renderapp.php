<?php
//This is a source code or part of Huggle project
//
//This file contains code for index page
//last modified by Addshore

//Copyright (C) 2011-2012 Huggle team

//This program is free software: you can redistribute it and/or modify
//it under the terms of the GNU General Public License as published by
//the Free Software Foundation, either version 3 of the License, or
//(at your option) any later version.

//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.
/* Huggle WA - includes/renderapp.php */

if ( !defined( 'HUGGLE' ) ) {
	echo "This is a part of huggle wa, unable to load config";
	die (1);
}

class Html {
public static $_page = "";
public static $_toolbar;
public static $_statusbar;
private static function Header() {
	global $hgwa_HtmlTitle;
	$hgwa_HtmlTitle = "Huggle WA"; // only temporary
	include "html/template_header";
}
private static function Menubuttons() {
	echo "\n<div class='menu'><div class='menubuttons'>";
}

public static function getBuffer ($html) {
	global $hgwa_HtmlTitle;
	self::$_page = self::$_page . $html;
}


private static function ToolBar() {
	global $hgwa_Debugging;
	self::$_toolbar = new Toolbar();
	self::$_toolbar->Create();
	self::$_toolbar->Render();	
}

private static function Menulogin() {
	global $hgwa_Username;
	echo "</div><div style=\"menulogin\">";
	if ($hgwa_Username === false) {
		echo '<a href="index.php?action=login">' . Core::GetMessage("login").'</a>';
	} else
	{
		echo "$hgwa_Username" . '<a href="index.php?action=logoff">' . Core::GetMessage("logout") . "</a></div>";
	}	
	echo "</div></div>";
}

public static function ChangeTitle( $content ) {
	global $hgwa_HtmlTitle;
	$hgwa_HtmlTitle = $content;
}

private static function Statsbar() {
	global $hgwa_Debugging;
	self::$_statusbar = new Statusbar();
}

private static function Content() {
	global $hgwa_Username, $hgwa_QueueWidth;
	echo "<div class=\"interface\">";
	// queue
	echo "<div class=\"queue\">" . Core::GetMessage("queue") . "\n</div>";
	// body
	echo "<div class=\"content\">";
	echo self::$_page;
	echo "</div></div>";

}

private static function Footer() {
	global $hgwa_HtmlTitle;
	include "html/template_footer";
}

public static function LoadContent() {
	require ("includes/ui/generictool.php");
	require ("includes/ui/toolbar.php");
	require ("includes/ui/statusbar.php"); 
	require ("includes/ui/jsdialog.php");
	self::Header();
	self::Menubuttons();
	self::ToolBar();
	self::Menulogin();
	self::Content();
	self::Statsbar();
	self::Footer();
	return 0;
}
}

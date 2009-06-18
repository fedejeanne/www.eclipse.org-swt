<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>SWT JNIGen Tool Metadata</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <link rel="stylesheet" href="http://dev.eclipse.org/default_style.css" type="text/css">
    <link rel="stylesheet" href="swt.css" type="text/css">
    <link rel="shortcut icon" href="http://www.eclipse.org/images/eclipse.ico" type="image/x-icon">
</head>
<body bgcolor="#ffffff" text="#000000">
<table width="875px" class="swtpage">
<colgroup><col width="125px"><col width="750px"></colgroup>
<tr><?php include "sidebar.php"; ?>
<td valign="top" style="padding: 10px"><h1 style="padding: 0; margin: 0; border-bottom: 1px solid #000000;">SWT JNI Tool Meta Data</h1>

<p>All of the C code used by SWT is generated by the <b>JNIGeneratorApp</b>
application included in the SWT Tools bundle and available on the 
<a href="updatesite.php">SWT Tools Update Sites</a>.

This page describes the metadata used to annotate the native methods and
structures to help the tool generate the appropriate C code. This metadata
is provide in the form of tags in the java doc comment. </p>


<h3> Tags </h3>

<ol>
<li> <b>@jniclass</b> <tt>&lt;metadata&gt;</tt></li>

	<p>Annotates a class. Classes can be either a structure class or a main class that contains natives.</p> 

<li> <b>@method</b> <tt>&lt;metadata&gt;</tt> </li>

	<p>Annotates a native method.</p></li>

<li> <b>@param</b> <tt>&lt;name&gt; &lt;metadata&gt;</tt>

	<p>Annotates a parameter of a native method. The parameter is identified by its name.</p></li>

<li> <b>@field</b> <tt>&lt;metadata&gt;</tt></li>

	<p>Annotates a field of a structure class.</p> 
</ol>

<h3> Metadata </h3>

<p> The metadata is a comma separated list of attributes of the form <i>key=value</i>. For example:

 <p><b>cast=(HWND),flags=flag1 flag2,accessor=othername</b></p> 
 
The key or value may not contain the comma character &lt;<b>,</b>&gt;. </p>


<h3> Attributes </h3>
<ol>
<li> <b>cast</b></li>
	<p>Provide the C cast of a structure field <i>@field</i> or native method parameter <i>@param</i>.</p>
<li> <b>accessor</b></li>
	<p>Provide the C name/identifier to be used instead of the java name. This can be used by structure fields <i>@field</i> or native methods <i>@method</i>.</p>
<li> <b>flags</b></li>
	<p>Provide switches to control how the C code is generated. Any tag may have this attribute. 
	Multiple flags are separated by a space character. See below for a list of the known flags.</p>
</ol>


<h3> Flags </h3>


<ol>
<li> <b>no_gen</b></li>
<p>Indicate that the item should not be generated. For example, custom natives are coded separately. Used in: <i>@jniclass</i>, <i>@method</i>, <i>@field</i></p>
<li> <b>no_in</b></li>
<p>Indicate that a native method parameter is an out only variable. This only makes sense if the parameter is a structure or an array of primitives. It is an optimization to avoid copying the java memory to C memory on the way in. Used in: <i>@param</i></p>
<li> <b>no_out</b></li>
<p>Indicate that a native method parameter is an in only variable. This only makes sense if the parameter is a structure or an array of primitives. It is an optimization to avoid copying the C memory from java memory on the way out. Used in: <i>@param</i></p>
<li> <b>critical</b></li>
<p>Indicate that <tt>GetPrimitiveArrayCritical()</tt> should be used instead of <tt>Get&lt;PrimitiveType&gt;ArrayElements()</tt> when transfering array of primitives from/to C. This is an optimization to avoid copying memory and must be used carefully. It is ok to be used in <tt>MoveMemory()</tt> and <tt>memmove()</tt> natives. Used in: <i>@param</i><p>
<li> <b>dynamic</b></li>
<p>Indicate that a native method should be looked up dynamically. It is useful when having a dependence on a given library is not desirable. 
The library name is specified in the *_custom.h file. Used in: <i>@method</i><p>
<li> <b>init</b></li>
<p>Indicate that the associated C local variable for a native method parameter should be initialized with zeros. Used in: <i>@param</i></p>
<li> <b>struct</b></li>
<p>Indicate that a structure parameter should be passed by value instead of by reference. This dereferences the parameter by prepending *. The parameter must not be NULL. Used in: <i>@param</i></p>
<li> <b>unicode</b></li>
<p>Indicates that <tt>GetStringChars()</tt>should be used instead of <tt>GetStringUTFChars()</tt> to get the characters of a java.lang.String passed as a parameter to native methods. Used in: <i>@param</i></p>
<li> <b>sentinel</b></li>
<p>Indicate that the parameter of a native method is the sentinel (last parameter of a variable argument C function). The generated code is always the literal <tt>NULL</tt>. Some compilers expect the sentinel to be the literal <tt>NULL</tt> and output a warning if otherwise. Used in: <i>@param</i></p>
<li> <b>const</b></li>
<p>Indicate that the native method represents a constant or global variable instead of a function. This omits <tt>()</tt> from the generated code. Used in: <i>@method</i></p>
<li> <b>cast</b></li>
<p>Indicate that the C function should be casted to a prototype generated from the parameters of the native method. Useful for variable argument C functions. Used in: <i>@method</i></p>
<li> <b>jni</b></li>
<p>Indicate that the native is part of the Java Native Interface. For exemple: <tt>NewGlobalRef()</tt>. Used in: <i>@method</i></p>
<li> <b>address</b></li>
<p>Indicate that the native method represents a structure global variable and the address of it should be returned to Java. This is done by prepending &amp;. Used in: <i>@method</i></p>
<li> <b>no_wince</b></li>
<p>Indicate that the item should be #ifdef out in the Windows CE platform, but not in the regular win32 platform. </p>
<li> <b>cpp</b></li>
<p></p>
<li> <b>new</b></li>
<p></p>
<li> <b>delete</b></li>
<p></p>
<li> <b>gcnew</b></li>
<p></p>
<li> <b>gcobject</b></li>
<p></p>
<li> <b>setter</b></li>
<p></p>
<li> <b>getter</b></li>
<p></p>
<li> <b>adder</b></li>
<p></p>
</ol>

</table>
</body>
</html>
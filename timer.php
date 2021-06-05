@extends('theme.default')

@section('content')
<html>
<head>
<title>Online Stopwatch allinworld99.blogspot.com</title>
<script type="text/javascript">

var t=[0, 0, 0, 0, 0, 0, 0, 1];

function ss() {
 t[t[2]]=(new Date()).valueOf();
 t[2]=1-t[2];

 if (0==t[2]) {
  clearInterval(t[4]);
  t[3]+=t[1]-t[0];
  var row=document.createElement('tr');
  var td=document.createElement('td');
  td.innerHTML=(t[7]++);
  row.appendChild(td);
  td=document.createElement('td');
  td.innerHTML=format(t[1]-t[0]);
  row.appendChild(td);
  td=document.createElement('td');
  td.innerHTML=format(t[3]);
  row.appendChild(td);
  document.getElementById('lap').appendChild(row);
  t[4]=t[1]=t[0]=0;
  disp();
 } else {
  t[4]=setInterval(disp, 43);
 }
}

function disp() {
 if (t[2]) t[1]=(new Date()).valueOf();
 t[6].value=format(t[3]+t[1]-t[0]);
}

function r() {
 if (t[2]) ss();
 t[4]=t[3]=t[2]=t[1]=t[0]=0;
 disp();
 document.getElementById('lap').innerHTML='';
 t[7]=1;
}


function format(ms) {
 // used to do a substr, but whoops, different browsers, different formats
 // so now, this ugly regex finds the time-of-day bit alone
 var d=new Date(ms+t[5]).toString()
  .replace(/.*([0-9][0-9]:[0-9][0-9]:[0-9][0-9]).*/, '$1');
 var x=String(ms%1000);
 while (x.length<3) x='0'+x;
 //d+='.'+x;
 return d;
}

function remote() {
 window.open(
  document.location, '_blank', 'width=700,height=350'
 );
 return false;
}
function load() {
 t[5]=new Date(1970, 1, 1, 0, 0, 0, 0).valueOf();
 t[6]=document.getElementById('disp');

 disp();

 if (!window.opener && window==window.top) {
  document.getElementById('remote').style.visibility='visible';
 }
}

</script>
<style type="text/css">
#lap {
 margin-top: 0.5em;
}

#main {
 text-align: center;
 white-space: nowrap;
}

#main button {
 padding: 0.4em;
 font-size: 1.1em;
}

#disp {
 background-color: white;
 font-size: 2em;
 width: 7.25em;
 font-family: "Courier New\n"}

#main button, #disp {
 width: 8em;
 vertical-align: middle;
}

#remote {
 position: absolute;
 top: 1px;
 right: 1px;

 visibility: hidden;
}

</style>
</head>

<body onload="load();">
<button onclick="remote();" id="remote">Remote</button>

<div id="main">
 <button type="button" onclick="ss()" onfocus="this.blur()">Start / Stop</button>
 <input type="text" id="disp">
 <button type="button" onclick="r()" onfocus="this.blur()">Reset</button>
</div>
<table border="1">
 <tbody><tr><th>Lap #</th><th>This Lap</th><th>Running Total</th></tr>
 </tbody><tbody id="lap"></tr></tbody>
</table>

</body>
</html>
@endsection

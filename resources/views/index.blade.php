<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home Page</title>

	<script>
		function validate()
		{var tel=document.getElementById("txtTel").value;
		var fName=document.getElementById("txtFullName").value;
		var regExp=/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
		var email=document.getElementById("txtEmail").value;
		var testTel=/^([0-9]{2}-[0-9]{3}-[0-9]{6})$/;
		var date=document.getElementById("txtDate").value;
		var time=document.getElementById("txtTime").value;
		var flag=true;
		if(fName=="")
		{
			alert("FullName must be entered");
			flag=false;
		}
		else if(email=="")
		{
			alert("FullName must be entered");
			flag=false;
		}
		else if(tel=="")
		{
			alert("Tel must be entered");
			flag=false;
		}
		else if(date=="")
		{
			alert("Date must be entered");
			flag=false;
		}
		else if(time=="")
		{
			alert("Time must be entered");
			flag=false;
		}
		else if(fName.length<5)
		{
			alert("Full name must be 5 characters at least");
			flag=false;
		}
		else if(!regExp.test(email))
			
		{
					alert("Email is invalid");
					flag=false;
		}
		else if(!testTel.test(tel))
		{
				alert("Tel is invalid");
				document.getElementById("txtTel").focus();
				flag=false;
		}
		if(flag==true)
		{
       return true;
    }
    else
      return false;
	}
	</script>
</head>
<body>
	
	<br>
	
	<nav>
		<ul>
			<li><a href="homepage.html">ABOUT US</a></li>
			<li class="a"><a href="">MENU</a></li>
			<li class="a"><a href="Reservation.html">RESERVATION</a></li>
			<li class="a" style="font-weight: bold;font-size: 200%"><a href="BaiThiMau.html"><i>BonBon</i></a></li>
			<li class="a"><a href="">EVENTS</a></li>
			<li class="a"><a href="">GALARY</a></li>
			<li class="a"><a href="">CONTACT</a></li>
		</ul>
	</nav>
	<section>
		<form id="123" action="" method="get" onsubmit="return validate()">
			<table  align="center">
				<th colspan="2">Online Booking</th>
			
			<tr>
		<td width="25%"><label>FullName</label>	</td>
		<td><input type="text" id="txtFullName"  size="54"  ></td>
		</tr>
		
		<tr>
		<td><label>Email</label>	</td>
		<td><input type="email"  id="txtEmail" size="54" ></td>
		</tr>
		<tr>
		<td><label>Phone Number</label>	</td>
		<td><input type="tel"   id="txtTel" size="54" ></td>
		</tr>
		<tr>
		<td><label>No. of Persons:</label>	</td>
		<td><select>
			<option  name="person" value="1 person">1 person</option>
			<option  name="person" value="2 person">2 person</option>
			<option  name="person" value="3 person">3 person</option>
			<option  name="person" value="4 person">4 person</option>
			<option  name="person" value="5 person">5 person</option>
			<option  name="person" value="None">None</option>
			</select>
			</td>
		</tr>
		<tr>
		<td><label>Set Date</label>	</td>
		<td><input type="date" id="txtDate"><td>
		</tr>
		<tr>
		<td><label>Time Set</label>	</td>
		<td><input type="time"   id="txtTime"><td>
		</tr>
		<tr>
		<td><label>Comment</label>	</td>
		<td><textarea name="Content" cols="50" rows="10"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="center"><input type="submit" name="btnOK" value="RESERVE A TABLE" onclick="validate()"></td>
			
		</tr>
		
			</table>

		</form>
	</section>
	<footer  align="center" style="font-size: 150%"> 2018 BonBon.All rights reserved</footer>
</body>
</html>
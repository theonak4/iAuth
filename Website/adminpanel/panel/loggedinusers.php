<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster|Russo+One" rel="stylesheet">
<?php
	$conn = new mysqli("127.0.0.1", "root", "e8jj3jhhaw", "iauth");
  $sql = "SELECT * FROM session_manager WHERE db='Jefferson Elementary'";
  $result = $conn->query($sql);
  $id;
  while($row = $result->fetch_assoc()) {
    $id = $row['id'];
  }
 ?>

<style>

.statusmessage {
  animation: fade-in 1.5s infinite;
}

.loader {
    border: 4px solid #16161d;
    border-top: 4px solid #4aa172;
    border-radius: 50%;
    width: 100px;
    height: 100px;
    animation: spin 0.5s linear infinite;
    margin-top: 150px;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
@-webkit-keyframes fade-in{
30% {opacity:1;}
70% {opacity:0;}
100% {opacity: 1;}
}
body,html {
  background: rgb(27,27,36);
   color: rgb(138,141,183);
  font-family: Roboto;
  font-weight: lighter;
}
h4 {
-webkit-animation:fade-in 2s infinite;
}

.progressbar {
  width: 700px;
  background: rgb(40,41,54);
  border: 4px solid rgb(40,41,54);
  border-radius: 5px;
  height: 20px;

}

.progress {
  height: 20px;
  background: rgb(74, 161, 114);
  color: rgb(27,27,36);
  border: 0;
  border-radius: 5px;
  float: left;
  transition: 2s;
}

.loadingbar {
  width: 700px;
  height: 5px;
  background: #16161d;
  margin-top: 250px;
}

.loadingbarprogress {
  height: 5px;
  background: linear-gradient(to right,#4aa172, #62b789, #4aa172);
  float: left;
  transition: 2s;
}

</style>
<table style="width: 100%">
  <tr>

  </tr>
  <tr>
    <td>Alfreds Futterkiste</td>
    <td>Maria Anders</td>
    <td>Germany</td>
  </tr>
  <tr>
    <td>Centro comercial Moctezuma</td>
    <td>Francisco Chang</td>
    <td>Mexico</td>
  </tr>
  <tr>
    <td>Ernst Handel</td>
    <td>Roland Mendel</td>
    <td>Austria</td>
  </tr>
  <tr>
    <td>Island Trading</td>
    <td>Helen Bennett</td>
    <td>UK</td>
  </tr>
  <tr>
    <td>Laughing Bacchus Winecellars</td>
    <td>Yoshi Tannamuri</td>
    <td>Canada</td>
  </tr>
  <tr>
    <td>Magazzini Alimentari Riuniti</td>
    <td>Giovanni Rovelli</td>
    <td>Italy</td>
  </tr>
</table>

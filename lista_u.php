<?php 
		///////////////////////////////////////////////////
		///			KONFIGURACJA - START 				///
		///////////////////////////////////////////////////
		
		// IP SERWERA
		define('ts_query_ip','80.211.246.247');
		
		// PORT SERWERA
		define('ts_server_port','9987');
		
		// PORT SERVERQUERY
		define('ts_query_port','10011');
		
		// NAZWA UŻYTKOWNIKA SERVERQUERY
		define('ts_query_username','admin');
		
		// HASŁO UŻYTKOWNIKA SERVERQUERY
		define('ts_query_password','BqgBgeit');
		
		// ścieżka do frameworka
		define('ts3framework','./framework/libraries/TeamSpeak3/TeamSpeak3.php');

		///////////////////////////////////////////////////
		///			KONFIGURACJA - KONIEC 				///
		///////////////////////////////////////////////////
	
		if(!@include(ts3framework)) exit("<h1>Nie znaleziono biblioteki TS3 PHP Framework. Możesz ją pobrać z <a href='https://github.com/planetteamspeak/ts3phpframework'>GitHub - TeamSpeak 3 PHP Framework</a></h1>");
		
		try{
			$ts = TeamSpeak3::factory("serverquery://".ts_query_username.":".ts_query_password."@".ts_query_ip.":".ts_query_port."/?server_port=".ts_server_port);
		}
		catch(Exception $e){
			// przypiszmy błąd do $e 
			// wyświetlmy kod błędu oraz jego treść
			echo '<h1>Nie można połączyć się z serwerem, sprawdź poprawność danych konfiguracyjnych</h1>';
			exit('Kod błędu: <b>'.$e->getCode().'</b> oraz treść błędu: <b>'.$e->getMessage().'</b>');
		}
		//odswiezanie co 30 s
		header('refresh: 30;');
		
		$clients = $ts->clientList();
		$channels = $ts->channelList();
?>

<?php
//łaczenie sie z baza i nadpisywanie dla danego uzytkownika ile czasu w sumie spedzil na serwerze
	
?>


<html>
	<head>		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Tabela użytkowników na serwerze TeamSpeak 3</title>
		
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/css/dataTables.bootstrap.css" />
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/jquery.dataTables.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.13/js/dataTables.bootstrap.min.js"></script>
		
		<script>
			$(document).ready( function () {
				$('#ts_users_table').DataTable();
			});
		</script>
	</head>
	
	<body>
		<div class="container">
			<h1>Lista użytkowników online</h1>
			<table id="ts_users_table" class="table">
				<thead>
					<tr>
						<th>Nick</th>
						<th>Czas online (minuty)</th>
						<th>Aktualny kanał</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						try{
							foreach($clients as $client){
								if($client['client_type']) continue;
								?>
								<tr>
									<td><?php echo htmlentities($client['client_nickname']); ?></td>
									<td><?php echo round($client['connection_connected_time']/60000, 0); ?></td>
									<td><?php echo htmlentities($channels[$client['cid']]); ?></td>
								</tr>
								<?php
							}
						}
						catch(Exception $e){
							echo 'Wystąpił błąd podczas generowania listy użytkowników: <br>Kod błędu: <code><b>'.$e->getCode().'</b></code> oraz treść błędu: <b><code>'.$e->getMessage().'</code></b>';
						}
					?>
				</tbody>
			</table>
		</div>
	</body>
</html>
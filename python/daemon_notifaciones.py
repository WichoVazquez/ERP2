import time
import mysql_connect
import emailtest

datab=mysql_connect.ConexionMysql()

def read_configuration():
	datab.conexion()
	print "imprimir configuracion"
	config=datab.consultaConfiguracion()
	if len(config)>0:
		global notificacion
		notificacion=emailtest.Notificacion(config[0], config[1], config[2], config[3])
		global seconds 
		seconds=int(config[4])
	else:
		print "no se pudo configurar nada"
	datab.cerrarConexion()		

def  do_something():
	datab.conexion()
	#datab.consultaEstadoCotizacion()
	#print "Va a enviar correo"
	result=datab.consultaCotizacionSinPagar()
	if len(result)>0:
		for row in result:
			#print "resultados %s , %s , %s " % (row[0], row[1], row[2])
			notificacion.enviarNotificacionSinPagarUsuario(row[2],row[1], row[0], row[3])
	else:
		print "No tiene el tamano suficiente"
	datab.cerrarConexion()

	#print("La hora es"+time.ctime())

def run():
	while True:
		read_configuration()
		do_something()
		time.sleep(seconds)#600=10 min
		

if __name__=="__main__":
	run()



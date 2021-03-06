 # -*- coding: utf-8 -*-
import time
from mysqlp.mysql_connect import ConexionMysql
from emailp.emailtest import Notificacion
from logp.logger import Logger

loger=Logger()
datab=ConexionMysql(loger)
def read_configuration():
	#loger.config()
	datab.conexion()
	loger.do_normal("se configuro la BD")
	
	config=datab.consultaConfiguracion()
	if len(config)>0:
		global notificacion
		notificacion=Notificacion(config[0], config[1], config[2], config[3])
		global seconds 
		seconds=int(config[4])
	else:
		loger.do_error("no se pudo configurar nada")
	datab.cerrarConexion()		

def  do_something():
		datab.conexion()
		#datab.consultaEstadoCotizacion()
		#print "Va a enviar correo"
		result=datab.consultaCotizacionSinPagar()
		if result is None:
			loger.do_normal("No hay Usuarios sin pagar")
		else:	
			if len(result)>0:
				for row in result:
					#print "resultados %s , %s , %s " % (row[0], row[1], row[2])
					notificacion.enviarNotificacionSinPagarUsuario(row[2],row[1], row[0], row[3])
					loger.do_normal("Correo 'Usuario sin Pagar' Enviado")
			else:
				loger.do_error("No tiene el tamaño suficiente")
		datab.cerrarConexion()
	#print("La hora es"+time.ctime())


def run():
	try:
		while True:
			read_configuration()
			do_something()
			time.sleep(seconds)#600=10 min
	except KeyboardInterrupt:
		loger.do_warning("----Interrumpido por el usuario----")
		pass
        	
		

if __name__=="__main__":
	run()



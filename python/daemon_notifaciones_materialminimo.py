 # -*- coding: utf-8 -*-
import time
import mysql_connect
import emailtest
import logger

loger=logger.Logger()
datab=mysql_connect.ConexionMysql(loger)
def read_configuration():
	#
	#loger.config()
	#datab.setLogger(loger)
	datab.conexion()
	loger.do_normal("se configuro la BD")
	
	config=datab.consultaConfiguracion()
	if len(config)>0:
		global notificacion
		notificacion=emailtest.Notificacion(config[0], config[1], config[2], config[3])
		global seconds 
		seconds=int(config[4])
	else:
		loger.do_error("no se pudo configurar nada")
	datab.cerrarConexion()		

def  do_something():
		datab.conexion()
		#datab.consultaEstadoCotizacion()
		#print "Va a enviar correo"
		result=datab.consultaMaterialMinimo()
		if result is None:
			loger.do_normal("No hay Usuarios sin pagar")
		else:	
			if len(result)>0:
				for row in result:
					#print "resultados %s , %s , %s " % (row[0], row[1], row[2])
					notificacion.enviarNotificacionMaterialMinimo("almacen@promexextintores.com",row[0], row[1], row[2])
					loger.do_normal("Correo 'Cantidad Minimo' Enviado")
			else:
				loger.do_error("No tiene el tamaño suficiente")
		datab.cerrarConexion()

def run():
	try:
		while True:
			read_configuration()
			do_something()
			time.sleep(seconds)#600=10 min
	except KeyboardInterrupt, SystemExit:
		loger.do_warning("----Interrumpido por el usuario----")
		pass
        	
		

if __name__=="__main__":
	run()



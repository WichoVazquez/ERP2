 # -*- coding: utf-8 -*-
import MySQLdb as mdb
import sys
from logp.logger import Logger
#export DYLD_LIBRARY_PATH=/usr/local/mysql/lib/ necesita estar esta variable y/o el link simbolico sudo ln -s /usr/local/mysql/lib/libmysqlclient.18.dylib /usr/lib/libmysqlclient.18.dylib 

class ConexionMysql:
	"""Clase para conexion con BD en MySQL a través de la libreria MySQLdb"""
	def __init__(self):
		"""Inicializador de Clase"""
		print "Inicia clase Mysql"

	def __init__(self, objetologer):
		"""Inicializador con Objeto de un Logger"""
		print "Inicia clase MySQL"
		self.loger=objetologer

	def conexion(self):
		"""Inicia Conexión a la BD"""
		try:
		    con = mdb.connect('localhost', 'promex_master', 'MePrendio', 'promex');

		    cur = con.cursor()
		    cur.execute("SELECT VERSION()")

		    ver = cur.fetchone()
		    #print "Database version : %s " % ver
		    self.con=con
		    self.cursor=con.cursor()

		except mdb.Error, e:
			err_msg="Error %d: %s" % (e.args[0],e.args[1])
			if self.loger is not None:
				self.loger.do_exception(err_msg)
			print err_msg
			sys.exit(1)
		    
	def consultaEstadoCotizacion(self):
			"""Consulta el estado de una cotización"""
		    self.cursor.execute("SELECT cotizacion_id from COTIZACION where cotizacion_edo=5")
		    res = self.cursor.fetchone()
		    print "Resultado: %s " % res

	def consultaCotizacionSinPagar(self):
			"""Consulta las cotizaciones sin pagar"""
		    self.cursor.execute("SELECT COTIZACION.cotizacion_id, GENERALES.nombre, GENERALES.email, CLIENTE.cliente_razonsocial from COTIZACION, GENERALES, USUARIO, CLIENTE where COTIZACION.cotizacion_edo=7 and COTIZACION.cliente_id=CLIENTE.cliente_id and USUARIO.usuario_id=COTIZACION.usuario_id and GENERALES.generales_id=USUARIO.generales_id")
		    if self.cursor.rowcount > 0:
		    	result=self.cursor.fetchall()
		    	return result
		    else:
		    	print "Ningun Resultado"

	def consultaMaterialMinimo(self):
			"""Consulta Materiales en su mínimo"""
		    self.cursor.execute("SELECT ALMACEN_MATERIAL.material_id, MATERIAL.material_descripcion, ALMACEN_MATERIAL.almacen_id from ALMACEN_MATERIAL, MATERIAL where ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo AND MATERIAL.material_id=ALMACEN_MATERIAL.material_id")
		    if self.cursor.rowcount > 0:
		    	result=self.cursor.fetchall()
		    	return result
		    else:
		    	print "Ningun Resultado"
		    	return None;
	def consultaMaterialCaducado(self):			
			"""Consulta Materiales Caducados"""
		    self.cursor.execute("SELECT ALMACEN_MATERIAL.material_id, MATERIAL.material_descripcion, ALMACEN_MATERIAL.almacen_id from ALMACEN_MATERIAL, MATERIAL where ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo AND MATERIAL.material_id=ALMACEN_MATERIAL.material_id")
		    if self.cursor.rowcount > 0:
		    	result=self.cursor.fetchall()
		    	return result
		    else:
		    	print "Ningun Resultado"

	def consultaCotizacionPendiente(self):
			"""Consulta Cotizaciones Pendientes"""
		    self.cursor.execute("SELECT ALMACEN_MATERIAL.material_id, MATERIAL.material_descripcion, ALMACEN_MATERIAL.almacen_id from ALMACEN_MATERIAL, MATERIAL where ALMACEN_MATERIAL.cantidad_actual<=ALMACEN_MATERIAL.minimo AND MATERIAL.material_id=ALMACEN_MATERIAL.material_id")
		    if self.cursor.rowcount > 0:
		    	result=self.cursor.fetchall()
		    	return result
		    else:
		    	print "Ningun Resultado"	    		    	

	def consultaConfiguracion(self):
			"""Consulta Configuracion"""
		    self.cursor.execute("SELECT servidor_smtp, puerto,usuario_correo_notificaciones, contrasena_usuario_correo_notificaciones,frecuencia_notificaciones_pago, frecuencia_notificaciones_cotizacion_a_pedido,frecuencia_notificaciones_material_minimo, frecuencia_notificaciones_material_caduco FROM configuracion")
		    res = self.cursor.fetchone()
		    return res	    	    			    
			

	def cerrarConexion(self):
		"""Cierra Conexión"""	            
		with self.con as con:
			if con:    
			    con.close()
			    print "Conexion Cerrada"


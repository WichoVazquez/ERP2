 # -*- coding: utf-8 -*-
import smtplib

class Notificacion:

	def __init__(self, servidor, puerto, usuario, password):
		print "Iniciando Clase Mail"
		self.servidor=servidor
		self.puerto=puerto
		self.sender=usuario
		self.password=password

	def enviarNotificacionSinPagarUsuario(self, usuariomail, usuarionombre, cotizacion, cliente):
		server_puerto= "%s:%s" % (self.servidor, self.puerto)	
		#server = smtplib.SMTP('smtp.soetecnologia.com:587') #cambiar de preferencia por el promex y que sea smtp
		server = smtplib.SMTP(server_puerto)
		server.ehlo()
		server.starttls()
		#sender="notificaciones@soetecnologia.com"
		#password="Notificashion2013"
		server.login(self.sender, self.password)
		msg = "\r\n".join([
		  "From: %s" % self.sender,
		  "To: %s " % usuariomail,
		  "Subject: Notificacion de Venta sin pagar",
		  "",
		  "Estimado %s: \n\nEl pedido correspondiente a la cotizacion no. %s no ha sido pagada por el cliente: %s. \n ---------------- \n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje." % (usuarionombre, cotizacion, cliente)
		  ])
		server.sendmail(self.sender, usuariomail, msg)
	def enviarNotificacionMaterialMinimo(self, usuariomail, materialid, materialdesc, almacen):
		server_puerto= "%s:%s" % (self.servidor, self.puerto)	
		#server = smtplib.SMTP('smtp.soetecnologia.com:587') #cambiar de preferencia por el promex y que sea smtp
		server = smtplib.SMTP(server_puerto)
		server.ehlo()
		server.starttls()
		#sender="notificaciones@soetecnologia.com"
		#password="Notificashion2013"
		server.login(self.sender, self.password)
		msg = "\r\n".join([
		  "From: %s" % self.sender,
		  "To: %s " % usuariomail,
		  "Subject: Notificacion de Material en Mnimo",
		  "",
		  "Estimado: \n\nEl material con clave %s: %s ha rebasado o llegó a su mínimo en el almacen: %s. \n ---------------- \n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje." % (materialid, materialdesc, almacen
		  	)
		  ])
		server.sendmail(self.sender, usuariomail, msg)
	def enviarNotificacionMaterialCaducado(self, usuariomail, materialid, materialdesc, almacen):
		server_puerto= "%s:%s" % (self.servidor, self.puerto)	
		#server = smtplib.SMTP('smtp.soetecnologia.com:587') #cambiar de preferencia por el promex y que sea smtp
		server = smtplib.SMTP(server_puerto)
		server.ehlo()
		server.starttls()
		#sender="notificaciones@soetecnologia.com"
		#password="Notificashion2013"
		server.login(self.sender, self.password)
		msg = "\r\n".join([
		  "From: %s" % self.sender,
		  "To: %s " % usuariomail,
		  "Subject: Notificacion de Material Caducadp",
		  "",
		  "Estimado: \n\nEl material con clave %s: %s  en el almacen: %s  esta caducado.\n ---------------- \n Este mensaje se envió desde una dirección de correo electrónico que solo envía notificaciones y no acepta mensajes de correo electrónico entrantes. No responda a este mensaje." % (materialid, materialdesc, almacen
		  	)
		  ])
		server.sendmail(self.sender, usuariomail, msg)		
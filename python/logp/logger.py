 # -*- coding: utf-8 -*-
import logging
import os
class Logger:
	def __init__(self):
		#print "Inicia clase Logging"
		FORMAT = '%(asctime)s  - %(levelname)s - %(message)s'
		FILENAME=os.path.dirname(os.path.realpath(__file__))+'/logger.log'
		logging.basicConfig(filename=FILENAME,format=FORMAT,level=logging.DEBUG)

	def do_error(self, mensaje):
		logging.error(mensaje)

	def do_warning(self, mensaje):
		logging.warning(mensaje)

	def do_normal(self,mensaje):
		logging.info(mensaje)

	def do_exception(self, mensaje):
		logging.exception(mensaje)	

				
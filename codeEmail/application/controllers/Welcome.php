<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function send_email() {

		$this->load->library('libMailer');

		//$mail = \PHPMailer\PHPMailer\PHPMailer::IsSMTP();
		$mail = new PHPMailer\PHPMailer\PHPMailer();

		$mail->IsSMTP();
		$mail->SMTPDebug = 2;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Helo = 'customcoding.com.mx';
        $mail->Host = 'mail.customcoding.com.mx';
        $mail->Port = '465';
        $mail->Username = 'noreply@customcoding.com.mx';
        $mail->Password = 'BVuSpJ,hW8j8';
        $mail->From = 'noreply@customcoding.com.mx';
        $mail->FromName = 'Custom Coding';
        $mail->IsHTML(true);
        $mail->CharSet = "UTF-8";

		//$mail->AddAddress('scrat.pedro@gmail.com');
		$mail->AddAddress('jonysthil@gmail.com');
		$mail->AddReplyTo('info@customcoding.com.mx');
		
		$contenido = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
				<title>Promoción</title>
			</head>
			<body style="margin: 0; padding: 0;">
				<table border="0" cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td>
		
							<!-- Header Top Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td>
										<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr>
												<td align="left"  bgcolor="#2e3537">
													<!-- Space -->
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
													</table>
													<table align="center">
														<tr>
															<td width="22"></td>
															<td width="22" style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;"><i class="fa fa-map-marker-alt"></i></td>
															<td style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">Fraccionamiento Las Americas, Ecatepec de Morelos, Méx., México</td>
															<td width="22"></td>
															<td width="22" style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;"><i class="fa fa-phone"></i></td>
															<td style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">5538030380</td>
															<td width="22"></td>
															<td width="22" style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;"><i class="fa fa-envelope"></i></td>
															<td>
																<a style="color: #fff; font-size: 12px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif; text-decoration:none;" href="mailto:info@customcoding.com.mx">info@customcoding.com.mx</a>
															</td>
															<td width="22"></td>
														</tr>
													</table>
													<!-- Space -->
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- Header Top End -->
		
							<!-- Header Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td style="padding:15px 0 0 0;">
										<table align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr style="background-color: #30393d; color: #ffffff;">
												<td>
													<table align="left" border="0" cellpadding="0" cellspacing="0" width="200" style="border-collapse: collapse;">
														<!-- logo -->
														<tr>
															<td align="left">
																<a target="_blank" href="https://customcoding.com.mx">
																	<img src="https://customcoding.com.mx/assets/images/brand.png" alt="Company Logo" style="display: block;"/>
																</a>
															</td>
														</tr>
														<!-- company slogan -->
														<tr>
															<td width="100%" align="left" style="font-size: 12px; line-height: 18px; font-family:helvetica, Arial, sans-serif; color:#999999;">	
																Consultoría Empresarial
															</td>
														</tr>									
														<!-- Space -->
														<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
													</table>
													<table align="left" border="0" cellpadding="0" cellspacing="0" width="370" style="border-collapse: collapse;">
														<tr>
															<td  height="75" style="text-align: right; vertical-align: middle;">
																<a target="_blank" href="https://customcoding.com.mx/portafolio.html" style="font-family:helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px; text-decoration: none;">Portafolio</a> &nbsp;&nbsp;
																<a target="_blank" href="https://customcoding.com.mx/blog.html" style="font-family:helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px; text-decoration: none;">Blog</a> &nbsp;&nbsp;
																<a target="_blank" href="https://customcoding.com.mx/contacto.html" style="font-family:helvetica, Arial, sans-serif; color: #ffffff; font-size: 16px; text-decoration: none;">Contacto</a>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- Header End -->
		
							<!-- Banner Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td>
										<table bgcolor="#fafafa" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr>
												<td>
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr>
															<td align="center" bgcolor="#ffffff" >
																<a href="#">
																	<img src="https://customcoding.com.mx/uploads/blog/20181206-211627-10-razones-por-las-que-deberias-invertir-en-una-pagina-web.jpeg" width="580" alt="Section one image" style="display: block;"/>
																</a>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<!-- Banner End -->
		
							<!-- Section Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td>
										<table bgcolor="#fafafa" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr>
												<td>
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
														<!-- Space -->
														<tr><td style="font-size: 0; line-height: 0;" bgcolor="#f5f5f5" height="1">&nbsp;</td></tr>
														<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
														<tr>
															<td width="100%" align="center" style="font-size: 28px; line-height: 34px; font-family:helvetica, Arial, sans-serif; color:#000000;">
																Nuestros <strong>Servicios</strong>
															</td>
														</tr>
														<!-- Space -->
														<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
													</table>
													<!-- First Row -->
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
														<tr>
															<td>
																<table align="left" border="0" cellpadding="0" width="290" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>
																			<a target="_blank" href="https://customcoding.com.mx/servicio/creacion-y-diseno-web.html">
																				<img src="https://images.pexels.com/photos/205316/pexels-photo-205316.png?cs=srgb&dl=apple-apple-devices-business-205316.jpg&fm=jpg" width="290" alt="Project 1" style="display: block;"/>
																			</a>
																		</td>
																	</tr>
																</table>
																<!-- Grid Gutter 20px -->
																<table align="left" border="0" cellpadding="0" width="20" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" width="260" cellspacing="0" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<a style="text-decoration:none; font-family: helvetica, Arial, sans-serif; font-size: 22px; color: #343434; line-height: 26px;" target="_blank" href="https://customcoding.com.mx/servicio/creacion-y-diseno-web.html">Creación y Diseño Web</a>
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td style="font-family: helvetica, Arial, sans-serif; font-size: 14px; color: #777777; line-height: 21px;">
																			Haga crecer su marca y negocio brindando a sus clientes un sitio donde encontrar sus productos y servicios...
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<table width="100" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																				<tr>
																					<td align="center" style="padding:8px 5px 8px 5px;border-radius:4px;" bgcolor="#3697d9">
																						<a href="https://customcoding.com.mx/servicio/creacion-y-diseno-web.html" target="_blank" style="color: #fff; font-size: 12px; line-height: 12px; font-weight: normal; text-decoration: none; font-family: helvetica, Arial, sans-serif;">Saber más</a>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<!-- Second Row -->
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
														<tr>
															<td>
																<!-- Grid Gutter 20px -->
																<table align="left" border="0" cellpadding="0" width="10" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" width="260" cellspacing="0" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<a style="text-decoration:none; font-family: helvetica, Arial, sans-serif; font-size: 22px; color: #343434; line-height: 26px;" target="_blank" href="https://customcoding.com.mx/servicio/administracion-de-su-sitio-web.html">Administración de su Sitio Web</a>
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td style="font-family: helvetica, Arial, sans-serif; font-size: 14px; color: #777777; line-height: 21px;">
																			Coubicación y arrendamiento de servidores dedicados, servidores virtuales, hospedaje compartido...
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<table width="100" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																				<tr>
																					<td align="center" style="padding:8px 5px 8px 5px;border-radius:4px;" bgcolor="#3697d9">
																						<a target="_blank" href="https://customcoding.com.mx/servicio/administracion-de-su-sitio-web.html" style="color: #fff; font-size: 12px; line-height: 12px; font-weight: normal; text-decoration: none; font-family: helvetica, Arial, sans-serif;">Saber más</a>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
																<!-- Grid Gutter 20px -->
																<table align="left" border="0" cellpadding="0" width="20" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" width="290" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>
																			<a href="https://customcoding.com.mx/servicio/administracion-de-su-sitio-web.html" target="_blank">
																				<img src="https://images.pexels.com/photos/7360/startup-photos.jpg?cs=srgb&dl=apple-browsing-computer-7360.jpg&fm=jpg" width="290" alt="Project 2" style="display: block;"/>
																			</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<!-- Third Row -->
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
														<tr>
															<td>
																<table align="left" border="0" cellpadding="0" width="290" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>
																			<a href="https://customcoding.com.mx/servicio/desarrollo-de-software.html" target="_blank">
																				<img src="https://images.pexels.com/photos/34600/pexels-photo.jpg?cs=srgb&dl=code-coder-codes-34600.jpg&fm=jpg" width="290" alt="Project 3" style="display: block;"/>
																			</a>
																		</td>
																	</tr>
																</table>
																<!-- Grid Gutter 20px -->
																<table align="left" border="0" cellpadding="0" width="20" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" width="260" cellspacing="0" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<a style="text-decoration:none; font-family: helvetica, Arial, sans-serif; font-size: 22px; color: #343434; line-height: 26px;" target="_blank" href="https://customcoding.com.mx/servicio/desarrollo-de-software.html">Desarrollo de Software</a>
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td style="font-family: helvetica, Arial, sans-serif; font-size: 14px; color: #777777; line-height: 21px;">
																			Soluciones de negocio basadas en la nube, desarrollo de apps móviles (Android e IOs), análisis y desarrollo de sistemas...
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<table width="100" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																				<tr>
																					<td align="center" style="padding:8px 5px 8px 5px;border-radius:4px;" bgcolor="#3697d9">
																						<a href="https://customcoding.com.mx/servicio/desarrollo-de-software.html" target="_blank" style="color: #fff; font-size: 12px; line-height: 12px; font-weight: normal; text-decoration: none; font-family: helvetica, Arial, sans-serif;">Saber más</a>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<!-- Fourth Row -->
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
														<tr>
															<td>
																<!-- Grid Gutter 20px -->
																<table align="left" border="0" cellpadding="0" width="10" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" width="260" cellspacing="0" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<a style="text-decoration:none; font-family: helvetica, Arial, sans-serif; font-size: 22px; color: #343434; line-height: 26px;" target="_blank" href="https://customcoding.com.mx/servicio/marketing-digital.html">Marketing Digital</a>
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="15">&nbsp;</td></tr>
																	<tr>
																		<td style="font-family: helvetica, Arial, sans-serif; font-size: 14px; color: #777777; line-height: 21px;">
																			Estrategias de comunicación, desarrollo de marca y posicionamiento de imagen en redes sociales en medios electrónicos...
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																	<tr>
																		<td>
																			<table width="100" align="left" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
																				<tr>
																					<td align="center" style="padding:8px 5px 8px 5px;border-radius:4px;" bgcolor="#3697d9">
																						<a href="https://customcoding.com.mx/servicio/marketing-digital.html" target="_blank" style="color: #fff; font-size: 12px; line-height: 12px; font-weight: normal; text-decoration: none; font-family: helvetica, Arial, sans-serif;">Saber más</a>
																					</td>
																				</tr>
																			</table>
																		</td>
																	</tr>
																</table>
																<!-- Grid Gutter 20px -->
																<table align="left" border="0" cellpadding="0" width="20" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>&nbsp;</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" width="290" cellspacing="0" style="border-collapse: collapse;">
																	<tr>
																		<td>
																			<a href="https://customcoding.com.mx/servicio/marketing-digital.html" target="_blank">
																				<img src="https://images.pexels.com/photos/1413653/pexels-photo-1413653.jpeg?cs=srgb&dl=adults-casual-cellphone-1413653.jpg&fm=jpg" width="290" alt="Project 4" style="display: block;"/>
																			</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
		
							</table>
							<!-- Section End -->
		
							<!-- Section Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td>
										<table align="center" bgcolor="#373737" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr>
												<td>
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<!-- Space -->
														<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
													</table>
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr>
															<td>
																<table align="left" border="0" cellpadding="0" cellspacing="0" width="430" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="3">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" align="center" style="font-size: 28px; line-height: 34px; font-family:helvetica, Arial, sans-serif; color:#ffffff;">
																			Que esperas, aprovecha.
																		</td>
																	</tr>
																</table>
																<table align="left" border="0" cellpadding="0" cellspacing="0" width="140" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="0">&nbsp;</td></tr>
																	<tr>
																		<td width="100%" align="center" style="padding:12px 12px 12px 12px; text-align: center;border-radius:4px;" bgcolor="#f1f1f1">
																			<a target="_blank" href="https://customcoding.com.mx/contacto.html" style="color: #000000; font-size: 16px; font-weight: normal; text-decoration: none; font-family: helvetica, Arial, sans-serif;">Contactanos</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<!-- Space -->
														<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
		
							</table>
							<!-- Section End -->
		
							<!-- Footer Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td>
										<table bgcolor="#ffffff" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr style="background-color: #30393d;">
												<td>
													<!-- Space -->
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
													</table>
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
														<tr>
															<td>
																<!-- First Column -->
																<table align="left" border="0" cellpadding="0" cellspacing="0" width="250" style="border-collapse: collapse;">
																	<tr>
																		<td>
																			<a href="https://customcoding.com.mx" target="_blank">
																				<img src="https://customcoding.com.mx/assets/images/brand.png" alt="Logo" style="display: block;"/>
																			</a>
																		</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
																	<tr>
																		<td style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">
																			Somos una empresa de consultoría en tecnologías de información, especializada en el desarrollo de aplicaciones y soluciones de negocio para medianas empresas en los sectores educativo,industrias diversas, empresas de servicio y gobierno.
																		</td>
																	</tr>
																</table>
																<!-- Gutter 20px -->
																<table align="left" border="0" cellpadding="0" cellspacing="0" width="40" style="border-collapse: collapse;">
																	<tr>
																		<td>
																			&nbsp;
																		</td>
																	</tr>
																</table>
																<!-- Second Column -->
																<table align="left" border="0" cellpadding="0" cellspacing="0" width="250" style="border-collapse: collapse;">
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="57">&nbsp;</td></tr>
																	<tr>
																		<td width="22" style="color:#ffffff;">
																			<i class="fa fa-map-marker-alt"></i>
																		</td>
																		<td style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">Fraccionamiento Las Americas, Ecatepec de Morelos, Méx., México</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																	<tr>
																		<td width="22" style="color:#ffffff;">
																			<i class="fa fa-phone"></i>
																		</td>
																		<td style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">5538030380</td>
																	</tr>
																	<!-- Space -->
																	<tr><td style="font-size: 0; line-height: 0;" height="10">&nbsp;</td></tr>
																	<tr>
																		<td width="22" style="color:#ffffff;">
																			<i class="fa fa-envelope"></i>
																		</td>
																		<td>
																			<a style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif; text-decoration:none;" href="mailto:info@customcoding.com.mx">info@customcoding.com.mx</a>
																		</td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
													<!-- Space -->
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr><td style="font-size: 0; line-height: 0;" height="30">&nbsp;</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
		
							</table>
							<!-- Footer End -->
		
							<!-- Subfooter Start -->
							<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border-collapse: collapse;">
								<tr>
									<td>
										<table bgcolor="#f5f5f5" align="center" border="0" cellpadding="0" cellspacing="0" width="580" style="border-collapse: collapse;">
											<tr>
												<td>
													<!-- Space -->
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
														<tr><td style="font-size: 0; line-height: 0;" bgcolor="#eaeaea" height="1">&nbsp;</td></tr>
														<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
													</table>
													<table align="center" border="0" cellpadding="0" cellspacing="0" width="540" style="border-collapse: collapse;">
														<tr>
															<td align="center" style="color: #999999; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif;">
																Copyright © 2019 by <a target="_blank" href="https://customcoding.com.mx" style="color: #3697d9; font-size: 14px; line-height: 18px; font-weight: normal; font-family: helvetica, Arial, sans-serif; text-decoration:none;">Custom Coding</a>. All Rights Reserved
															</td>
														</tr>
													</table>
													<!-- Space -->
													<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
														<tr><td style="font-size: 0; line-height: 0;" height="20">&nbsp;</td></tr>
													</table>
												</td>
											</tr>
										</table>
									</td>
								</tr>
		
							</table>
							<!-- Subfooter End -->
					
		
						</td>
					</tr>
				</table>
			</body>
		</html>';

        $mail->Subject = 'Comienza un 2019 con un sitio web nuevo, Pregunta por nuestras ofertas';
        $mail->Body = $contenido;

		$envio = $mail->Send();
		
		if ($envio) {
			echo "email enviado";
		} else {
			echo "error al enviar";
		}
	}
}

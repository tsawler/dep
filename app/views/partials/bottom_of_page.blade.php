<!--close .container role="main-content" --> 
	<!--begin footer -->
	<footer id="footer" class="clearfix">
		<div class="container"><!--footer container-->

			<div class="row-fluid">
				<div class="span4">
					<section>
						<h4>Contact Us</h4>
						<p>The Dog-Eared Press<br>
							PO Box 1234<br>
							Fredericton NB Canada<br>
							E3B 1B1<br>
							<strong>phone:</strong> <a href="tel:5064742804" class="tele">506.474.2804</a><br>
							<strong>email:</strong> <a href="mailto:info@dogearedpress.ca">info@dogearedpress.ca</a> </p>
					</section>
					<!--close section-->
					
				</div>
				<!-- close .span4 --> 
				
				<!--section containing newsletter signup and recent images-->
				<div class="span4">
					<section>
						<h4>Conferences &amp; Shows</h4>
						<p>We'll be coming to a show near you soon!
						Watch this section for conference &amp; show related news.
						</p>
					</section>
					<section>
						<h4>Follow Us</h4>
						<ul class="social">
							<li><a class="socicon rss" href="/blog.rss" title="RSS"></a></li>
							<li><a class="socicon facebook" href="https://www.facebook.com/dogearedpress" title="Facebook"></a></li>
							<li><a class="socicon twitterbird" href="https://twitter.com/dogearedpress" title="Twitter"></a></li>
						</ul>
					</section>	
					
					<!--close section--> 
				</div>
				<!-- close .span4 --> 
				
				<div class="span4">
					<section>
						<h4>Stay Updated</h4>
						<p>Sign up for our newsletter. We won't share your email address.</p>
						{{ Form::open(array('url' => '/joinlist', 'class' => 'form-horizontal', 'method' => 'post')) }}
							<div class="input-append row-fluid">
								{{ Form::text('email', null, array('id' => 'span6', 'placeholder' => 'you@example.com')); }}
								{{ Form::submit('Sign up', array('class' => 'btn btn-primary')); }}
							</div>
							<!--close input-append-->
						{{ Form::close() }}
					</section>
					<!--close section-->

				</div>
				<!-- close .span4 --> 
			</div>
			<!-- close .row-fluid--> 
		</div>
		<!-- close footer .container--> 
		
		<section class="footerCredits">
			<div class="container">
				<ul class="clearfix">
					<li>Copyright &copy; <?php echo date("Y");?> Dog-Eared Press</li>
					<li><a href="#">Site Map</a></li>
					<li><a href="#">Privacy</a></li>
				</ul>
			</div>
			<!--footerCredits container--> 
		</section>
		<!--close section--> 
	</footer>
	<!--/.footer--> 
	
	<span class="backToTop"><a href="#top">back to top</a></span> 
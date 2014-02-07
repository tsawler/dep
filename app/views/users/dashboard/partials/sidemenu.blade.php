		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li>
							<a href="/users/dashboard">
							@if (Request::path() == "users/dashboard")
								<strong>
							@endif
								Dashboard
							@if (Request::path() == "users/dashboard")
								</strong>
							@endif
							</a>
						</li>
						<li>
							<a href="/users/account">
							@if (Request::path() == "users/account")
								<strong>
							@endif
								Your Account
							@if (Request::path() == "users/account")
								</strong>
							@endif
							</a>
						</li>
						<li>
							<a href="/users/author">
							@if (Request::path() == "users/author")
								<strong>
							@endif
								Author Details
							@if (Request::path() == "users/author")
								</strong>
							@endif
							</a>
						</li>
						<li>
							<a href="/users/password">
							@if (Request::path() == "users/password")
								<strong>
							@endif
								Change Password
							@if (Request::path() == "users/password")
								</strong>
							@endif
							</a>
						</li>
						<li>
							<a href="/users/security">
							@if (Request::path() == "users/security")
								<strong>
							@endif
								Security
							@if (Request::path() == "users/security")
								</strong>
							@endif
							</a>
						</li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
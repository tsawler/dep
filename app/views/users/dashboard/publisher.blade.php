@extends('layout')

@section('browser-title')
Dashboard: Author Account Details: The Dog-Eared Press
@stop

@section('content')
<div class="container clearfix" id="main-content"> 
	<div class="row-fluid sidebar-right">

		<div class="span9 primary-column"> 
			

			<h3 class="short_headline" style="text-transform: none;"><span>Author's Account Details</span></h3>
			
			@if($publisher != null)
			{{ Form::model($publisher, array(
										'class' => 'form-horizontal', 
										'name' => 'bookform', 'id' => 'bookform',
										'url' => array('users/author', $publisher->id )
										) 
						   )
			}}
			@else
			{{ Form::open(array('url' => 'users/author', 'class' => 'form-horizontal', 'name' => 'bookform', 'id' => 'bookform')) }}
			@endif
			
			<p>This information is only required if you are publishing with us,
			or if you intend to publish with us.</p>
			
			<div class="control-group">
			{{  Form::label('phone', 'Phone', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-phone"></i></span>
			{{  Form::text('phone', null, array('class'=>'required'));}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('address', 'Address', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-home"></i></span>
			{{  Form::text('address', null, array('class'=>'required'));}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('city', 'City/Town', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-map-marker"></i></span>
			{{  Form::text('city', null, array('class'=>'required'));}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('province', 'Province/State', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on">P</span>
			{{ Form::select('province', array(
				'AB' => 'Alberta',
				'BC' => 'British Columbia',
				'MB' => 'Manitoba',
				'NB' => 'New Brunswick',
				'NL' => 'Newfoundland and Labrador',
				'NS' => 'Nova Scotia',
				'ON' => 'Ontario',
				'PE' => 'Prince Edward Island',
				'QC' => 'Quebec',
				'SK' => 'Saskatchewan',
				'NT' => 'Northwest Territories',
				'NU' => 'Nunavut',
				'YT' => 'Yukon',
				'AL' => 'Alabama',
				'AK' => 'Alaska',
				'AZ' => 'Arizona',
				'AR' => 'Arkansas',
				'CA' => 'California',
				'CO' => 'Colorado',
				'CT' => 'Connecticut',
				'DE' => 'Delaware',
				'DC' => 'District Of Columbia',
				'FL' => 'Florida',
				'GA' => 'Georgia',
				'HI' => 'Hawaii',
				'ID' => 'Idaho',
				'IL' => 'Illinois',
				'IN' => 'Indiana',
				'IA' => 'Iowa',
				'KS' => 'Kansas',
				'KY' => 'Kentucky',
				'LA' => 'Louisiana',
				'ME' => 'Maine',
				'MD' => 'Maryland',
				'MA' => 'Massachusetts',
				'MI' => 'Michigan',
				'MN' => 'Minnesota',
				'MS' => 'Mississippi',
				'MO' => 'Missouri',
				'MT' => 'Montana',
				'NE' => 'Nebraska',
				'NV' => 'Nevada',
				'NH' => 'New Hampshire',
				'NJ' => 'New Jersey',
				'NM' => 'New Mexico',
				'NY' => 'New York',
				'NC' => 'North Carolina',
				'ND' => 'North Dakota',
				'OH' => 'Ohio',
				'OK' => 'Oklahoma',
				'OR' => 'Oregon',
				'PA' => 'Pennsylvania',
				'RI' => 'Rhode Island',
				'SC' => 'South Carolina',
				'SD' => 'South Dakota',
				'TN' => 'Tennessee',
				'TX' => 'Texas',
				'UT' => 'Utah',
				'VT' => 'Vermont',
				'VA' => 'Virginia',
				'WA' => 'Washington',
				'WV' => 'West Virginia',
				'WI' => 'Wisconsin',
				'WY' => 'Wyoming'
				)); 
			}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('province_other', 'Province/State (specify)', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on">O</span>
			{{  Form::text('province_other', null);}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			
			<div class="control-group">
			{{  Form::label('country', 'Country', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on"><i class="icon icon-flag-alt"></i></span>
			{{ Form::select('country', array(
				'ca' => 'Canada',
				'us' => 'United States',
				'af' => 'Afghanistan',
				'ax' => '&Aring;land Islands',
				'al' => 'Albania',
				'dz' => 'Algeria',
				'as' => 'American Samoa',
				'ad' => 'Andorra',
				'ao' => 'Angola',
				'ai' => 'Anguilla',
				'aq' => 'Antarctica',
				'ag' => 'Antigua and Barbuda',
				'ar' => 'Argentina',
				'am' => 'Armenia',
				'aw' => 'Aruba',
				'au' => 'Australia',
				'at' => 'Austria',
				'az' => 'Azerbaijan',
				'bs' => 'Bahamas',
				'bh' => 'Bahrain',
				'bd' => 'Bangladesh',
				'bb' => 'Barbados',
				'by' => 'Belarus',
				'be' => 'Belgium',
				'bz' => 'Belize',
				'bj' => 'Benin',
				'bm' => 'Bermuda',
				'bt' => 'Bhutan',
				'bo' => 'Bolivia',
				'ba' => 'Bosnia and Herzegovina',
				'bw' => 'Botswana',
				'bv' => 'Bouvet Island',
				'br' => 'Brazil',
				'io' => 'British Indian Ocean Territory',
				'bn' => 'Brunei Darussalam',
				'bg' => 'Bulgaria',
				'bf' => 'Burkina Faso',
				'bi' => 'Burundi',
				'kh' => 'Cambodia',
				'cm' => 'Cameroon',
				'cv' => 'Cape Verde',
				'ky' => 'Cayman Islands',
				'cf' => 'Central African Republic',
				'td' => 'Chad',
				'cl' => 'Chile',
				'cn' => 'China',
				'cx' => 'Christmas Island',
				'cc' => 'Cocos (Keeling) Islands',
				'co' => 'Colombia',
				'km' => 'Comoros',
				'cg' => 'Congo',
				'cd' => 'Congo, The Democratic Republic of The',
				'ck' => 'Cook Islands',
				'cr' => 'Costa Rica',
				'ci' => 'Cote D&apos;ivoire',
				'hr' => 'Croatia',
				'cu' => 'Cuba',
				'cy' => 'Cyprus',
				'cz' => 'Czech Republic',
				'dk' => 'Denmark',
				'dj' => 'Djibouti',
				'dm' => 'Dominica',
				'do' => 'Dominican Republic',
				'ec' => 'Ecuador',
				'eg' => 'Egypt',
				'sv' => 'El Salvador',
				'gq' => 'Equatorial Guinea',
				'er' => 'Eritrea',
				'ee' => 'Estonia',
				'et' => 'Ethiopia',
				'fk' => 'Falkland Islands (Malvinas)',
				'fo' => 'Faroe Islands',
				'fj' => 'Fiji',
				'fi' => 'Finland',
				'fr' => 'France',
				'gf' => 'French Guiana',
				'pf' => 'French Polynesia',
				'tf' => 'French Southern Territories',
				'ga' => 'Gabon',
				'gm' => 'Gambia',
				'ge' => 'Georgia',
				'de' => 'Germany',
				'gh' => 'Ghana',
				'gi' => 'Gibraltar',
				'gr' => 'Greece',
				'gl' => 'Greenland',
				'gd' => 'Grenada',
				'gp' => 'Guadeloupe',
				'gu' => 'Guam',
				'gt' => 'Guatemala',
				'gg' => 'Guernsey',
				'gn' => 'Guinea',
				'gw' => 'Guinea-bissau',
				'gy' => 'Guyana',
				'ht' => 'Haiti',
				'hm' => 'Heard Island and Mcdonald Islands',
				'va' => 'Holy See (Vatican City State)',
				'hn' => 'Honduras',
				'hk' => 'Hong Kong',
				'hu' => 'Hungary',
				'is' => 'Iceland',
				'in' => 'India',
				'id' => 'Indonesia',
				'ir' => 'Iran, Islamic Republic of',
				'iq' => 'Iraq',
				'ie' => 'Ireland',
				'im' => 'Isle of Man',
				'il' => 'Israel',
				'it' => 'Italy',
				'jm' => 'Jamaica',
				'jp' => 'Japan',
				'je' => 'Jersey',
				'jo' => 'Jordan',
				'kz' => 'Kazakhstan',
				'ke' => 'Kenya',
				'ki' => 'Kiribati',
				'kp' => 'Korea, Democratic People&apos;s Republic of',
				'kr' => 'Korea, Republic of',
				'kw' => 'Kuwait',
				'kg' => 'Kyrgyzstan',
				'la' => 'Lao People&apos;s Democratic Republic',
				'lv' => 'Latvia',
				'lb' => 'Lebanon',
				'ls' => 'Lesotho',
				'lr' => 'Liberia',
				'ly' => 'Libyan Arab Jamahiriya',
				'li' => 'Liechtenstein',
				'lt' => 'Lithuania',
				'lu' => 'Luxembourg',
				'mo' => 'Macao',
				'mk' => 'Macedonia, The Former Yugoslav Republic of',
				'mg' => 'Madagascar',
				'mw' => 'Malawi',
				'my' => 'Malaysia',
				'mv' => 'Maldives',
				'ml' => 'Mali',
				'mt' => 'Malta',
				'mh' => 'Marshall Islands',
				'mq' => 'Martinique',
				'mr' => 'Mauritania',
				'mu' => 'Mauritius',
				'yt' => 'Mayotte',
				'mx' => 'Mexico',
				'fm' => 'Micronesia, Federated States of',
				'md' => 'Moldova, Republic of',
				'mc' => 'Monaco',
				'mn' => 'Mongolia',
				'me' => 'Montenegro',
				'ms' => 'Montserrat',
				'ma' => 'Morocco',
				'mz' => 'Mozambique',
				'mm' => 'Myanmar',
				'na' => 'Namibia',
				'nr' => 'Nauru',
				'np' => 'Nepal',
				'nl' => 'Netherlands',
				'an' => 'Netherlands Antilles',
				'nc' => 'New Caledonia',
				'nz' => 'New Zealand',
				'ni' => 'Nicaragua',
				'ne' => 'Niger',
				'ng' => 'Nigeria',
				'nu' => 'Niue',
				'nf' => 'Norfolk Island',
				'mp' => 'Northern Mariana Islands',
				'no' => 'Norway',
				'om' => 'Oman',
				'pk' => 'Pakistan',
				'pw' => 'Palau',
				'ps' => 'Palestinian Territory, Occupied',
				'pa' => 'Panama',
				'pg' => 'Papua New Guinea',
				'py' => 'Paraguay',
				'pe' => 'Peru',
				'ph' => 'Philippines',
				'pn' => 'Pitcairn',
				'pl' => 'Poland',
				'pt' => 'Portugal',
				'pr' => 'Puerto Rico',
				'qa' => 'Qatar',
				're' => 'Reunion',
				'ro' => 'Romania',
				'ru' => 'Russian Federation',
				'rw' => 'Rwanda',
				'sh' => 'Saint Helena',
				'kn' => 'Saint Kitts and Nevis',
				'lc' => 'Saint Lucia',
				'pm' => 'Saint Pierre and Miquelon',
				'vc' => 'Saint Vincent and The Grenadines',
				'ws' => 'Samoa',
				'sm' => 'San Marino',
				'st' => 'Sao Tome and Principe',
				'sa' => 'Saudi Arabia',
				'sn' => 'Senegal',
				'rs' => 'Serbia',
				'sc' => 'Seychelles',
				'sl' => 'Sierra Leone',
				'sg' => 'Singapore',
				'sk' => 'Slovakia',
				'si' => 'Slovenia',
				'sb' => 'Solomon Islands',
				'so' => 'Somalia',
				'za' => 'South Africa',
				'gs' => 'South Georgia and The South Sandwich Islands',
				'es' => 'Spain',
				'lk' => 'Sri Lanka',
				'sd' => 'Sudan',
				'sr' => 'Suriname',
				'sj' => 'Svalbard and Jan Mayen',
				'sz' => 'Swaziland',
				'se' => 'Sweden',
				'ch' => 'Switzerland',
				'sy' => 'Syrian Arab Republic',
				'tw' => 'Taiwan, Province of China',
				'tj' => 'Tajikistan',
				'tz' => 'Tanzania, United Republic of',
				'th' => 'Thailand',
				'tl' => 'Timor-leste',
				'tg' => 'Togo',
				'tk' => 'Tokelau',
				'to' => 'Tonga',
				'tt' => 'Trinidad and Tobago',
				'tn' => 'Tunisia',
				'tr' => 'Turkey',
				'tm' => 'Turkmenistan',
				'tc' => 'Turks and Caicos Islands',
				'tv' => 'Tuvalu',
				'ug' => 'Uganda',
				'ua' => 'Ukraine',
				'ae' => 'United Arab Emirates',
				'gb' => 'United Kingdom',
				'um' => 'United States Minor Outlying Islands',
				'uy' => 'Uruguay',
				'uz' => 'Uzbekistan',
				'vu' => 'Vanuatu',
				've' => 'Venezuela',
				'vn' => 'Viet Nam',
				'vg' => 'Virgin Islands, British',
				'vi' => 'Virgin Islands, U.S.',
				'wf' => 'Wallis and Futuna',
				'eh' => 'Western Sahara',
				'ye' => 'Yemen',
				'zm' => 'Zambia',
				'zw' => 'Zimbabwe'
				));
			}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			
			
			<div class="control-group">
			{{  Form::label('zip', 'Zip/Postal Code', array('class' => 'control-label')); }}
			<div class="controls">
			<div class="input-prepend"> <span class="add-on">Z</span>
			{{  Form::text('zip', null, array('class'=>'required'));}}
			<span class='help-inline'></span>
			</div>
			</div>
			</div>
			

		
			<hr>
			
			<div class="control-group">
			<div class="controls">
			{{ Form::submit('Save Account Details', array('class' => 'btn btn-primary')); }}
			<button type="reset" class="btn">Cancel</button>
			</div>
			</div>
			
			{{ Form::close() }}
		</div> <!-- /span9 primary column -->
	
		<section class="span3 sidebar secondary-column" id="secondary-nav">
			<aside class="widget">
					<h5 class="short_headline"><span>Menu</span></h5>
					<ul class="navigation">
						<li><a href='/users/dashboard'>Dashboard</a></li>
						<li><a href='/users/account'>Your Account</a></li>
						<li><a href="/users/author"><strong>Author Details</strong></a></li>
						<li><a href='/users/password'>Change Password</a></li>
						<li><a href="/users/security">Security</a></li>
					</ul>
				</aside>
				<!--close aside widget-->
		</section>
	</div>
</div>
@stop

@section('bottom-js')
<script>
$(document).ready(function () {	
	$("#bookform").validate({
		highlight: function(element) {
	        $(element).closest('.control-group').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.control-group').removeClass('error');
	        $(element).closest('.control-group').addClass('success');
	    },
	    errorElement: 'span',
	    errorClass: 'help-inline',
	    errorPlacement: function(error, element) {
	        error.insertAfter(element.parent());
	    }
	});
});
</script>
@stop
<?php
/**
 * The template for displaying company info.
 * Requires a valid stock symbol with exchange passed: e.g. NASDAQ:AAPL
 */

get_header(); 

$STOCK = new Stock(get_query_var('symbol'));
$cArr = $STOCK->companyInfo; // grab company info

//output if a valid symbol with data
if(strlen($cArr[0]->companyName)){ ?>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<img src="<?= $cArr[0]->image; ?>" alt="<?= $cArr[0]->companyName; ?> logo">

				<h1><?php echo $cArr[0]->companyName; ?></h1>

				<p class="text-muted">TMF Company Profile: (<a href="<?php echo site_url('/company/'.$STOCK->longSymbol.'/'); ?>"><?= $STOCK->longSymbol; ?></a>)</p>
			</div>
		</div>
	</div>
	
	<section id="primary" class="content-area col-sm-12 col-lg-8">
		<div id="main" class="site-main" role="main">

			<p><?php echo $cArr[0]->description; ?></p>

			<?php
			$paged = get_query_var('paged') ? absint( get_query_var('paged') ) : 1;

			//SECTION 1: Recommendations
			//output  only if on "page 1" for Other Coverage section
			if($paged == 1){
				get_template_part('template-parts/content-companyinfo', 'recommendations');
			}

			//SECTION2: Other Coverage
			get_template_part('template-parts/content-companyinfo','other', array('paged' => $paged));
}
else{
	echo '<p>SYMBOL: '. $STOCK->longSymbol .' is not valid.</p>';
}
?>

		</div><!-- #main -->
	</section><!-- #primary -->

<?php

get_sidebar(null,array('version' => 'stock'));
get_footer();

/*
    [ { "symbol" : "AAPL", "price" : 117.34, "beta" : 1.33758, "volAvg" : 153793993, "mktCap" : 1994991080000, "lastDiv" : 1.4224999999999999, "range" : "53.1525-137.98", "changes" : -1.3, "companyName" : "Apple Inc", "currency" : "USD", "cik" : "0000320193", "isin" : "US0378331005", "cusip" : "037833100", "exchange" : "Nasdaq Global Select", "exchangeShortName" : "NASDAQ", "industry" : "Consumer Electronics", "website" : "https://www.apple.com/", "description" : "Apple Inc. designs, manufactures, and markets smartphones, personal computers, tablets, wearables, and accessories worldwide. It also sells various related services. The company offers iPhone, a line of smartphones; Mac, a line of personal computers; iPad, a line of multi-purpose tablets; and wearables, home, and accessories comprising AirPods, Apple TV, Apple Watch, Beats products, HomePod, iPod touch, and other Apple-branded and third-party accessories. It also provides AppleCare support services; cloud services store services; and operates various platforms, including the App Store, that allow customers to discover and download applications and digital content, such as books, music, video, games, and podcasts. In addition, the company offers various services, such as Apple Arcade, a game subscription service; Apple Music, which offers users a curated listening experience with on-demand radio stations; Apple News+, a subscription news and magazine service; Apple TV+, which offers exclusive original content; Apple Card, a co-branded credit card; and Apple Pay, a cashless payment service, as well as licenses its intellectual property. The company serves consumers, and small and mid-sized businesses; and the education, enterprise, and government markets. It sells and delivers third-party applications for its products through the App Store. The company also sells its products through its retail and online stores, and direct sales force; and third-party cellular network carriers, wholesalers, retailers, and resellers. Apple Inc. was founded in 1977 and is headquartered in Cupertino, California.", "ceo" : "Mr. Timothy Cook", "sector" : "Technology", "country" : "US", "fullTimeEmployees" : "137000", "phone" : "14089961010", "address" : "1 Apple Park Way", "city" : "Cupertino", "state" : "CALIFORNIA", "zip" : "95014", "dcfDiff" : 89.92, "dcf" : 127.377, "image" : "https://financialmodelingprep.com/image-stock/AAPL.png", "ipoDate" : "1980-12-12", "defaultImage" : false } ]
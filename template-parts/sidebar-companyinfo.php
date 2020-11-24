<?php

global $STOCK; 

if(strlen($STOCK->shortSymbol)){

	$cArr = $STOCK->companyInfo;

	//If companyName has something we assume all the data is there
	if(strlen($cArr[0]->companyName)): ?>

		<div class="card">
		  <img class="mx-auto p-3" src="<?= $cArr[0]->image; ?>" alt="<?= $cArr[0]->companyName ?> logo">
		    <ul class="list-group list-group-flush">
		      <li class="list-group-item"><strong><?= $cArr[0]->companyName; ?></strong> (<?= $cArr[0]->exchangeShortName; ?>:<?= $cArr[0]->symbol; ?>)</li>
			  <li class="list-group-item"><strong>Industry</strong>: <?= $cArr[0]->industry; ?></li>
			  <li class="list-group-item"><strong>Sector</strong>: <?= $cArr[0]->sector; ?></li>
			</ul>
		  <div class="card-body">
		    <p class="card-text small"><?= $cArr[0]->description; ?></p>
		  </div>
		  <ul class="list-group list-group-flush">
		      <li class="list-group-item"><strong>CEO:</strong> <?= $cArr[0]->ceo; ?></li>
		      <li class="list-group-item"><strong>Website:</strong> <a href="<?= $cArr[0]->website; ?>" target="_blank" rel="nofollow"><?= $cArr[0]->website; ?></a></li>
		  </ul>
		</div>

<?php 
	endif;
}

/*
[ { "symbol" : "AAPL", "price" : 117.34, "beta" : 1.33758, "volAvg" : 153793993, "mktCap" : 1994991080000, "lastDiv" : 1.4224999999999999, "range" : "53.1525-137.98", "changes" : -1.3, "companyName" : "Apple Inc", "currency" : "USD", "cik" : "0000320193", "isin" : "US0378331005", "cusip" : "037833100", "exchange" : "Nasdaq Global Select", "exchangeShortName" : "NASDAQ", "industry" : "Consumer Electronics", "website" : "https://www.apple.com/", "description" : "Apple Inc. designs, manufactures, and markets smartphones, personal computers, tablets, wearables, and accessories worldwide. It also sells various related services. The company offers iPhone, a line of smartphones; Mac, a line of personal computers; iPad, a line of multi-purpose tablets; and wearables, home, and accessories comprising AirPods, Apple TV, Apple Watch, Beats products, HomePod, iPod touch, and other Apple-branded and third-party accessories. It also provides AppleCare support services; cloud services store services; and operates various platforms, including the App Store, that allow customers to discover and download applications and digital content, such as books, music, video, games, and podcasts. In addition, the company offers various services, such as Apple Arcade, a game subscription service; Apple Music, which offers users a curated listening experience with on-demand radio stations; Apple News+, a subscription news and magazine service; Apple TV+, which offers exclusive original content; Apple Card, a co-branded credit card; and Apple Pay, a cashless payment service, as well as licenses its intellectual property. The company serves consumers, and small and mid-sized businesses; and the education, enterprise, and government markets. It sells and delivers third-party applications for its products through the App Store. The company also sells its products through its retail and online stores, and direct sales force; and third-party cellular network carriers, wholesalers, retailers, and resellers. Apple Inc. was founded in 1977 and is headquartered in Cupertino, California.", "ceo" : "Mr. Timothy Cook", "sector" : "Technology", "country" : "US", "fullTimeEmployees" : "137000", "phone" : "14089961010", "address" : "1 Apple Park Way", "city" : "Cupertino", "state" : "CALIFORNIA", "zip" : "95014", "dcfDiff" : 89.92, "dcf" : 127.377, "image" : "https://financialmodelingprep.com/image-stock/AAPL.png", "ipoDate" : "1980-12-12", "defaultImage" : false } ]
*/
?>
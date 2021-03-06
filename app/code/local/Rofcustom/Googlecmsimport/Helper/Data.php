<?php

function in_array_r($needle, $haystack, $strict = false) {
    foreach ($haystack as $item) {
        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_r($needle, $item, $strict))) {
            return true;
        }
    }

    return false;
}


class Rofcustom_Googlecmsimport_Helper_Data extends Mage_Core_Helper_Abstract {

    protected $_releaseAllPages = true;

    protected $_releasedPages = array(
        "2014-09-12" => array(
            "locations/alabama",
            "locations/alaska",
            "locations/arizona",
            "locations/arkansas",
            "locations/california",
            "locations/colorado",
            "locations/connecticut",
            "locations/delaware",
            "locations/district-of-columbia",
            "locations/florida",
            "locations/georgia",
            "locations/hawaii",
            "locations/idaho",
            "locations/illinois",
            "locations/indiana",
            "locations/iowa",
            "locations/kansas",
            "locations/kentucky",
            "locations/louisiana",
            "locations/maine",
            "locations/maryland",
            "locations/massachusetts",
            "locations/michigan",
            "locations/minnesota",
            "locations/mississippi",
            "locations/missouri"
        ),
        "2014-09-16" => array(
            "locations/montana",
            "locations/nebraska",
            "locations/nevada",
            "locations/new-hampshire",
            "locations/new-jersey",
            "locations/new-mexico",
            "locations/new-york",
            "locations/north-carolina",
            "locations/north-dakota",
            "locations/ohio",
            "locations/oklahoma",
            "locations/oregon",
            "locations/pennsylvania",
            "locations/rhode-island",
            "locations/south-carolina",
            "locations/south-dakota",
            "locations/tennessee",
            "locations/texas",
            "locations/utah",
            "locations/vermont",
            "locations/virginia",
            "locations/washington",
            "locations/west-virginia",
            "locations/wisconsin",
            "locations/wyoming"
        ),
        "2014-09-18" => array(
            "locations/new-york/new-york-city",
            "locations/california/los-angeles",
            "locations/illinois/chicago",
            "locations/texas/houston",
            "locations/pennsylvania/philadelphia",
            "locations/arizona/phoenix",
            "locations/texas/san-antonio",
            "locations/california/san-diego",
            "locations/texas/dallas",
            "locations/california/san-jose",
            "locations/texas/austin",
            "locations/florida/jacksonville",
            "locations/indiana/indianapolis",
            "locations/california/san-francisco",
            "locations/ohio/columbus",
            "locations/texas/fort-worth",
            "locations/north-carolina/charlotte",
            "locations/michigan/detroit",
            "locations/texas/el-paso",
            "locations/tennessee/memphis",
            "locations/massachusetts/boston",
            "locations/washington/seattle",
            "locations/colorado/denver",
            "locations/district-of-columbia/washington",
            "locations/tennessee/nashville",
            "locations/maryland/baltimore",
            "locations/kentucky/louisville",
            "locations/oregon/portland",
            "locations/oklahoma/oklahoma-city",
            "locations/wisconsin/milwaukee"
        ),
        "2014-09-22" => array(
            "locations/nevada/las-vegas",
            "locations/new-mexico/albuquerque",
            "locations/arizona/tucson",
            "locations/california/fresno",
            "locations/california/sacramento",
            "locations/california/long-beach",
            "locations/missouri/kansas-city",
            "locations/arizona/mesa",
            "locations/virginia/virginia-beach",
            "locations/georgia/atlanta",
            "locations/colorado/colorado-springs",
            "locations/north-carolina/raleigh",
            "locations/nebraska/omaha",
            "locations/florida/miami",
            "locations/california/oakland",
            "locations/oklahoma/tulsa",
            "locations/minnesota/minneapolis",
            "locations/ohio/cleveland",
            "locations/kansas/wichita",
            "locations/texas/arlington"
        ),
        "2014-09-24" => array(
            "locations/louisiana/new-orleans",
            "locations/hawaii/honolulu",
            "locations/missouri/st-louis",
            "locations/california/santa-ana",
            "locations/ohio/cincinnati",
            "locations/california/anaheim",
            "locations/florida/tampa",
            "locations/ohio/toledo",
            "locations/pennsylvania/pittsburgh",
            "locations/colorado/aurora",
            "locations/california/bakersfield",
            "locations/california/riverside",
            "locations/california/stockton",
            "locations/texas/corpus-christi",
            "locations/kentucky/lexington",
            "locations/new-york/buffalo",
            "locations/minnesota/st-paul",
            "locations/alaska/anchorage",
            "locations/new-jersey/newark",
            "locations/texas/plano",
            "locations/indiana/fort-wayne",
            "locations/florida/st-petersburg",
            "locations/arizona/glendale",
            "locations/nebraska/lincoln",
            "locations/virginia/norfolk",
            "locations/new-jersey/jersey-city",
            "locations/north-carolina/greensboro",
            "locations/arizona/chandler",
            "locations/alabama/birmingham",
            "locations/nevada/henderson"
        ),
        "2014-09-25" => array(
            //"locations/new-york/north-hempstead",
            "locations/wisconsin/madison",
            "locations/florida/hialeah",
            "locations/louisiana/baton-rouge",
            "locations/virginia/chesapeake",
            "locations/florida/orlando",
            "locations/texas/lubbock",
            "locations/texas/garland",
            "locations/ohio/akron",
            "locations/new-york/rochester",
            "locations/california/chula-vista",
            "locations/nevada/reno",
            "locations/texas/laredo",
            "locations/north-carolina/durham",
            "locations/california/modesto",
            //"locations/new-york/huntington",
            "locations/alabama/montgomery",
            "locations/idaho/boise-city",
            "locations/virginia/arlington",
            "locations/california/san-bernardino"
        ),
        "2014-09-26" => array(
            "locations/california/irvine",
            "locations/north-carolina/winston-salem",
            "locations/texas/irving",
            "locations/nevada/north-las-vegas",
            "locations/california/fremont",
            "locations/virginia/richmond",
            "locations/washington/spokane",
            "locations/iowa/des-moines",
            "locations/north-carolina/fayetteville",
            "locations/washington/tacoma",
            "locations/california/oxnard",
            "locations/california/fontana",
            "locations/georgia/columbus",
            "locations/california/moreno-valley",
            "locations/louisiana/shreveport",
            "locations/illinois/aurora",
            "locations/new-york/yonkers",
            "locations/california/huntington-beach",
            "locations/arkansas/little-rock",
            "locations/georgia/augusta",
            "locations/texas/amarillo",
            "locations/california/glendale",
            "locations/alabama/mobile",
            "locations/michigan/grand-rapids",
            "locations/utah/salt-lake-city",
            "locations/florida/tallahassee",
            "locations/alabama/huntsville",
            "locations/texas/grand-prairie",
            "locations/tennessee/knoxville",
            "locations/massachusetts/worcester"
        ),
        "2014-09-29" => array(
//"locations/virginia/newport-news",
//"locations/texas/brownsville",
            "locations/kansas/overland-park",
            "locations/california/santa-clarita",
            "locations/rhode-island/providence",
            "locations/california/garden-grove",
            "locations/tennessee/chattanooga",
            "locations/california/oceanside",
            "locations/mississippi/jackson",
            "locations/florida/fort-lauderdale",
            "locations/california/santa-rosa",
            "locations/california/rancho-cucamonga",
            "locations/florida/port-st-lucie",
            "locations/california/ontario",
            "locations/washington/vancouver",
            "locations/florida/cape-coral",
            "locations/south-dakota/sioux-falls",
            "locations/missouri/springfield",
            "locations/florida/pembroke-pines",
//"locations/california/elk-grove",
            "locations/oregon/salem",
//"locations/california/lancaster",
//"locations/california/corona",
            "locations/oregon/eugene",
//"locations/california/palmdale",
//"locations/california/salinas",
            "locations/massachusetts/springfield",
            "locations/texas/pasadena",
            "locations/colorado/fort-collins",
//"locations/california/hayward",
            "locations/california/pomona",
//"locations/north-carolina/cary",
            "locations/illinois/rockford",
//"locations/virginia/alexandria",
//"locations/california/escondido",
            "locations/texas/mckinney",
            "locations/kansas/kansas-city",
            "locations/illinois/joliet",
//"locations/california/sunnyvale",
//"locations/california/torrance",
            "locations/connecticut/bridgeport",
            "locations/colorado/lakewood",
            "locations/florida/hollywood"
        ),
        "2014-09-30" => array(
            "locations/new-jersey/paterson",
            "locations/illinois/naperville",
            "locations/new-york/syracuse",
            "locations/texas/mesquite",
            "locations/ohio/dayton",
            "locations/georgia/savannah",
            "locations/tennessee/clarksville",
//"locations/california/orange",
//"locations/california/pasadena",
//"locations/california/fullerton",
//"locations/texas/killeen",
//"locations/texas/frisco",
            "locations/virginia/hampton",
            "locations/texas/mcallen",
            "locations/michigan/warren",
            "locations/washington/bellevue",
            "locations/utah/west-valley-city",
            "locations/south-carolina/columbia",
            "locations/kansas/olathe",
            "locations/michigan/sterling-heights",
            "locations/connecticut/new-haven",
            "locations/florida/miramar",
            "locations/texas/waco",
//"locations/california/thousand-oaks",
            "locations/iowa/cedar-rapids",
            "locations/south-carolina/charleston",
            "locations/california/visalia",
            "locations/kansas/topeka",
            "locations/new-jersey/elizabeth",
            "locations/florida/gainesville",
//"locations/colorado/thornton",
//"locations/california/roseville",
            "locations/texas/carrollton",
            "locations/florida/coral-springs",
            "locations/connecticut/stamford",
//"locations/california/simi-valley",
//"locations/california/concord",
            "locations/connecticut/hartford",
//"locations/washington/kent",
            "locations/louisiana/lafayette",
//"locations/texas/midland",
//"locations/texas/denton",
//"locations/california/victorville",
            "locations/indiana/evansville"
        ),
        "2014-10-01" => array(
//"locations/california/santa-clara",
            "locations/texas/abilene",
            "locations/georgia/athens",
            "locations/california/vallejo",
            "locations/pennsylvania/allentown",
            "locations/oklahoma/norman",
//"locations/texas/beaumont",
            "locations/missouri/independence",
//"locations/tennessee/murfreesboro",
            "locations/michigan/ann-arbor",
            "locations/illinois/springfield",
            "locations/california/berkeley",
            "locations/illinois/peoria",
            "locations/utah/provo",
//"locations/california/el-monte",
            "locations/missouri/columbia",
            "locations/michigan/lansing",
            "locations/north-dakota/fargo",
//"locations/california/downey",
            "locations/california/costa-mesa",
            "locations/north-carolina/wilmington",
//"locations/colorado/arvada",
//"locations/california/inglewood",
            "locations/florida/miami-gardens",
            "locations/california/carlsbad",
//"locations/colorado/westminster",
            "locations/minnesota/rochester",
            "locations/texas/odessa",
            "locations/new-hampshire/manchester",
//"locations/illinois/elgin",
            "locations/utah/west-jordan",
//"locations/texas/round-rock",
            "locations/florida/clearwater",
            "locations/connecticut/waterbury",
            "locations/oregon/gresham",
//"locations/california/fairfield",
            "locations/montana/billings",
            "locations/massachusetts/lowell",
            "locations/california/ventura",
            "locations/colorado/pueblo",
            "locations/north-carolina/high-point"
        ),
        "2014-10-02" => array(
//"locations/california/west-covina",
            "locations/arizona/scottsdale",
            "locations/california/richmond",
//"locations/california/murrieta",
            "locations/massachusetts/cambridge",
//"locations/california/antioch",
//"locations/california/temecula",
//"locations/california/norwalk",
//"locations/colorado/centennial",
            "locations/washington/everett",
            "locations/florida/palm-bay",
            "locations/texas/wichita-falls",
            "locations/wisconsin/green-bay",
//"locations/california/daly-city",
//"locations/california/burbank",
//"locations/texas/richardson",
            "locations/florida/pompano-beach",
            "locations/south-carolina/north-charleston",
//"locations/oklahoma/broken-arrow",
            "locations/colorado/boulder",
            "locations/florida/west-palm-beach",
            "locations/california/santa-maria",
//"locations/california/el-cajon",
            "locations/iowa/davenport",
//"locations/california/rialto",
//"locations/new-jersey/edison",
            "locations/new-mexico/las-cruces",
            "locations/california/san-mateo",
//"locations/texas/lewisville",
            "locations/indiana/south-bend",
            "locations/florida/lakeland",
            "locations/pennsylvania/erie",
//"locations/texas/tyler",
//"locations/texas/pearland",
//"locations/texas/college-station"
        ),
        "2014-10-03" => array(
            "locations/south-dakota/aberdeen",
            "locations/washington/aberdeen",
            "locations/georgia/albany",
            "locations/new-york/albany",
            "locations/florida/amelia-island",
            "locations/iowa/ames",
            "locations/washington/anacortes",
            "locations/maryland/annapolis",
            "locations/alabama/anniston",
            "locations/wisconsin/appleton",
            "locations/texas/aransas-pass",
            "locations/north-carolina/asheville",
            "locations/ohio/ashtabula",
            "locations/florida/atlantic-beach",
            "locations/north-carolina/atlantic-beach",
            "locations/new-jersey/atlantic-city",
            "locations/alabama/auburn",
            "locations/maine/auburn",
            "locations/north-carolina/avon",
            "locations/north-carolina/bald-head",
            "locations/oregon/bandon",
            "locations/maine/bangor",
            "locations/vermont/barre",
            "locations/michigan/battle-creek",
            "locations/oregon/bay-city",
            "locations/washington/bay-view",
            "locations/ohio/beachwood",
            "locations/south-carolina/beaufort",
            "locations/maine/belfast",
            "locations/nebraska/bellevue"
        ),
        "2014-10-04" => array(
            "locations/washington/bellingham",
            "locations/minnesota/bemidji",
            "locations/delaware/bethany-beach",
            "locations/florida/big-pine-key",
            "locations/mississippi/biloxi",
            "locations/new-york/binghamton",
            "locations/washington/birch-bay",
            "locations/north-dakota/bismarck",
            "locations/washington/blaine",
            "locations/illinois/bloomington",
            "locations/indiana/bloomington",
            "locations/minnesota/bloomington",
            "locations/florida/boca-raton",
            "locations/florida/bonita-springs",
            "locations/north-carolina/boone",
            "locations/maryland/bowie",
            "locations/kentucky/bowling-green",
            "locations/florida/boynton-beach",
            "locations/montana/bozeman",
            "locations/minnesota/brainerd",
            "locations/new-york/brighton-beach",
            "locations/oregon/brookings",
            "locations/south-dakota/brookings",
            "locations/texas/brownville",
            "locations/maine/brunswick",
            "locations/vermont/burlington",
            "locations/montana/butte-silver-bow",
            "locations/california/cambria",
            "locations/oregon/cannon-beach",
            "locations/ohio/canton"
        ),
        "2014-10-05" => array(
            "locations/massachusetts/cape-cod",
            "locations/north-carolina/carolina-beach",
            "locations/wyoming/casper",
            "locations/california/cayucos",
            "locations/illinois/champaign-urbana",
            "locations/california/channel-island-beach",
            "locations/illinois/charleston",
            "locations/west-virginia/charleston",
            "locations/virginia/charlottesville",
            "locations/new-york/chautauqua",
            "locations/wyoming/cheyenne",
            "locations/california/chico",
            "locations/ohio/chillicothe",
            "locations/florida/cocoa-beach",
            "locations/new-hampshire/concord",
            "locations/tennessee/cookeville",
            "locations/oregon/coos-bay",
            "locations/florida/coral-gables",
            "locations/north-carolina/corolla",
            "locations/california/corona-del-mar",
            "locations/kentucky/covington",
            "locations/rhode-island/cranston",
            "locations/california/crescent-city",
            "locations/california/dana-point",
            "locations/virginia/danville",
            "locations/florida/daytona-beach",
            "locations/alabama/decatur",
            "locations/illinois/decatur",
            "locations/texas/del-rio",
            "locations/florida/delray"
        ),
        "2014-10-06" => array(
            "locations/massachusetts/dennis",
            "locations/oregon/depoe-bay",
            "locations/washington/des-moines",
            "locations/alabama/dothan",
            "locations/delaware/dover",
            "locations/new-hampshire/dover",
            "locations/iowa/dubuque",
            "locations/florida/duck-key",
            "locations/minnesota/duluth",
            "locations/wisconsin/eau-clair",
            "locations/south-carolina/edisto-island",
            "locations/california/el-segundo",
            "locations/nevada/elko",
            "locations/north-carolina/emerald-isle",
            "locations/california/encinitas",
            "locations/vermont/essex-junction",
            "locations/california/eureka",
            "locations/alaska/fairbanks",
            "locations/new-mexico/farmington",
            "locations/arkansas/fayetteville",
            "locations/washington/fidalgo-island",
            "locations/north-carolina/figure-eight-island",
            "locations/new-york/finger-lakes",
            "locations/florida/flagler-beach",
            "locations/arizona/flagstaff",
            "locations/michigan/flint",
            "locations/alabama/florence",
            "locations/oregon/florence",
            "locations/south-carolina/florence",
            "locations/south-carolina/folly-beach"
        ),
        "2014-10-07" => array(
            "locations/california/fort-bragg",
            "locations/iowa/fort-dodge",
            "locations/texas/fort-hood",
            "locations/florida/fort-myers",
            "locations/florida/fort-pierce",
            "locations/arkansas/fort-smith",
            "locations/florida/fort-walton-beach",
            "locations/maryland/frederick",
            "locations/virginia/fredericksburg",
            "locations/texas/freeport",
            "locations/alabama/gadsden",
            "locations/maryland/gaithersburg",
            "locations/texas/galveston",
            "locations/oregon/garibaldi",
            "locations/indiana/gary",
            "locations/wyoming/gillette",
            "locations/oregon/gleneden-beach",
            "locations/new-york/glens-falls",
            "locations/oregon/gold-beach",
            "locations/california/goleta",
            "locations/north-dakota/grand-forks",
            "locations/nebraska/grand-island",
            "locations/montana/great-falls",
            "locations/south-carolina/greenville",
            "locations/california/grover-beach",
            "locations/california/gualala",
            "locations/mississippi/gulfport",
            "locations/ohio/hamilton",
            "locations/maine/hampton-beach",
            "locations/california/hanford"
        ),
        "2014-10-08" => array(
            "locations/oregon/harbor",
            "locations/pennsylvania/harrisburg",
            "locations/virginia/harrisonburg",
            "locations/massachusetts/harwich-port",
            "locations/north-carolina/hatteras-island",
            "locations/mississippi/hattiesburg",
            "locations/montana/helena",
            "locations/california/hermosa-beach",
            "locations/north-carolina/hickory",
            "locations/oregon/hillsboro",
            "locations/hawaii/hilo",
            "locations/south-carolina/hilton-head",
            "locations/georgia/hinesville",
            "locations/new-jersey/hoboken",
            "locations/north-carolina/holden-beach",
            "locations/michigan/holland",
            "locations/florida/homestead",
            "locations/louisiana/houma",
            "locations/massachusetts/humarock",
            "locations/california/humboldt",
            "locations/west-virginia/huntington",
            "locations/massachusetts/hyannis",
            "locations/idaho/idaho-city",
            "locations/california/imperial-beach",
            "locations/florida/indian-harbour-beach",
            "locations/california/inland-empire",
            "locations/iowa/iowa-city",
            "locations/florida/islamorada",
            "locations/south-carolina/isle-of-palms",
            "locations/new-york/ithaca"
        ),
        "2014-10-09" => array(
            "locations/michigan/jackson",
            "locations/tennessee/jackson",
            "locations/florida/jacksonville-beach",
            "locations/north-carolina/jacksonville",
            "locations/wisconsin/janesville",
            "locations/georgia/jekyll-island",
            "locations/california/jenner",
            "locations/arkansas/jonesboro",
            "locations/missouri/joplin",
            "locations/alaska/juneau",
            "locations/florida/jupiter",
            "locations/hawaii/kailua",
            "locations/michigan/kalamazoo",
            "locations/montana/kalispell",
            "locations/hawaii/kaneohe",
            "locations/nebraska/kearney",
            "locations/washington/kennewick",
            "locations/wisconsin/kenosha",
            "locations/florida/key-largo",
            "locations/florida/key-west",
            "locations/south-carolina/kiawah-island",
            "locations/missouri/kirksville",
            "locations/florida/kissimmee",
            "locations/oregon/klamath-falls",
            "locations/indiana/kokomo",
            "locations/washington/la-conner",
            "locations/wisconsin/la-crosse",
            "locations/california/la-jolla",
            "locations/texas/la-porte",
            "locations/indiana/lafayette"
        ),
        "2014-10-10" => array(
            "locations/california/laguna-beach",
            "locations/louisiana/lake-charles",
            "locations/missouri/lake-of-the-ozarks",
            "locations/florida/lake-worth",
            "locations/oregon/lakeside",
            "locations/pennsylvania/lancaster",
            "locations/wyoming/laramie",
            "locations/kansas/lawrence",
            "locations/oklahoma/lawton",
            "locations/texas/league-city",
            "locations/pennsylvania/lehigh-valley",
            "locations/idaho/lewiston",
            "locations/maine/lewiston",
            "locations/ohio/lima",
            "locations/oregon/lincoln-city",
            "locations/california/little-river",
            "locations/utah/logan",
            "locations/new-york/long-beach",
            "locations/washington/long-beach",
            "locations/new-jersey/long-branch",
            "locations/new-york/long-island",
            "locations/ohio/lorain",
            "locations/california/los-osos",
            "locations/washington/lummi-island",
            "locations/virginia/lynchburg",
            "locations/georgia/macon",
            "locations/california/malibu",
            "locations/california/manchester",
            "locations/california/manhattan-beach",
            "locations/new-york/manhattan-beach"
        ),
        "2014-10-11" => array(
            "locations/kansas/manhattan",
            "locations/minnesota/mankato",
            "locations/massachusetts/manomet",
            "locations/ohio/mansfield",
            "locations/florida/marathon",
            "locations/florida/marco-island",
            "locations/california/marina",
            "locations/massachusetts/marthas-vineyard",
            "locations/iowa/mason-city",
            "locations/california/mckinleyville",
            "locations/pennsylvania/meadville",
            "locations/oregon/medford",
            "locations/california/mendocino",
            "locations/ohio/mentor",
            "locations/california/merced",
            "locations/idaho/meridian",
            "locations/mississippi/meridian",
            "locations/florida/miami-beach",
            "locations/delaware/middletown",
            "locations/north-dakota/minot",
            "locations/montana/missoula",
            "locations/louisiana/monroe",
            "locations/michigan/monroe",
            "locations/california/monterey",
            "locations/west-virginia/morgantown",
            "locations/california/morro-bay",
            "locations/washington/moses-lake",
            "locations/south-carolina/mount-pleasant",
            "locations/california/muir-beach",
            "locations/indiana/muncie"
        ),
        "2014-10-12" => array(
            "locations/michigan/muskegon",
            "locations/south-carolina/myrtle-beach",
            "locations/north-carolina/nags-head",
            "locations/idaho/nampa",
            "locations/massachusetts/nantucket",
            "locations/california/napa",
            "locations/florida/naples-beach",
            "locations/new-hampshire/nashua",
            "locations/california/national-city",
            "locations/florida/neptune-beach",
            "locations/oregon/netarts",
            "locations/massachusetts/new-bedford",
            "locations/maine/new-gloucester",
            "locations/virginia/new-river-valley",
            "locations/delaware/newark",
            "locations/california/newport-beach",
            "locations/oregon/newport",
            "locations/rhode-island/newport",
            "locations/oregon/north-bend",
            "locations/florida/north-miami-beach",
            "locations/south-carolina/north-myrtle-beach",
            "locations/nebraska/north-platte",
            "locations/washington/oak-harbor",
            "locations/north-carolina/oak-island",
            "locations/florida/ocala",
            "locations/maryland/ocean-city",
            "locations/new-jersey/ocean-city",
            "locations/north-carolina/ocean-isle-beach",
            "locations/washington/ocean-park",
            "locations/washington/ocean-shores"
        ),
        "2014-10-13" => array(
            "locations/florida/okaloosa",
            "locations/kentucky/owensboro",
            "locations/oregon/pacific-city",
            "locations/california/pacific-palisades",
            "locations/florida/palm-coast",
            "locations/california/palm-springs",
            "locations/california/palos-verdes-estates",
            "locations/florida/panama-city",
            "locations/west-virginia/parkersburg",
            "locations/ohio/parma",
            "locations/south-carolina/pawleys-island",
            "locations/rhode-island/pawtucket",
            "locations/florida/pensacola",
            "locations/south-dakota/pierre",
            "locations/california/pismo-beach",
            "locations/new-york/plattsburgh",
            "locations/california/playa-del-rey",
            "locations/massachusetts/plymouth",
            "locations/idaho/pocatello",
            "locations/california/point-arena",
            "locations/california/point-loma",
            "locations/florida/pompano",
            "locations/florida/ponte-verde",
            "locations/washington/port-angeles",
            "locations/texas/port-aransas",
            "locations/texas/port-arthur",
            "locations/florida/port-charlotte",
            "locations/california/port-hueneme",
            "locations/michigan/port-huron",
            "locations/texas/port-isabel"
        ),
        "2014-10-14" => array(
            "locations/texas/port-lavaca",
            "locations/texas/port-mansfield",
            "locations/florida/port-saint-lucie",
            "locations/maine/portland",
            "locations/north-carolina/portsmouth-island",
            "locations/maine/portsmouth",
            "locations/arizona/prescott",
            "locations/massachusetts/provincetown",
            "locations/washington/pullman",
            "locations/iowa/quad-cities",
            "locations/wisconsin/racine",
            "locations/california/rancho-palos-verdes",
            "locations/south-dakota/rapid-city",
            "locations/washington/raymond",
            "locations/pennsylvania/reading",
            "locations/california/redding",
            "locations/california/redondo-beach",
            "locations/oregon/reedsport",
            "locations/indiana/richmond",
            "locations/new-mexico/rio-rancho",
            "locations/florida/riviera-beach",
            "locations/virginia/roanoke",
            "locations/new-hampshire/rochester",
            "locations/south-carolina/rock-hill",
            "locations/wyoming/rock-springs",
            "locations/texas/rockport",
            "locations/maryland/rockville",
            "locations/oregon/roseburg",
            "locations/new-mexico/roswell",
            "locations/vermont/rutland"
        ),
        "2014-10-15" => array(
            "locations/massachusetts/sagamore-beach",
            "locations/maine/salem",
            "locations/kansas/salina",
            "locations/north-carolina/salvo",
            "locations/washington/samish-island",
            "locations/texas/san-angelo",
            "locations/california/san-clemente",
            "locations/texas/san-marcos",
            "locations/california/san-pedro",
            "locations/ohio/sandusky",
            "locations/massachusetts/sandwich",
            "locations/utah/sandy",
            "locations/california/santa-barbara",
            "locations/california/santa-cruz",
            "locations/new-mexico/santa-fe",
            "locations/california/santa-monica",
            "locations/florida/sarasota",
            "locations/florida/sawgrass",
            "locations/nebraska/scottsbluff",
            "locations/georgia/sea-island",
            "locations/california/sea-ranch",
            "locations/oregon/seal-rock",
            "locations/maine/seapoint-beach",
            "locations/oregon/seaside",
            "locations/arizona/sedona",
            "locations/wisconsin/sheboygan",
            "locations/arizona/sierra-vista",
            "locations/iowa/sioux-city",
            "locations/alaska/sitka",
            "locations/delaware/smyrna"
        ),
        "2014-10-16" => array(
            "locations/california/sonoma",
            "locations/oregon/south-beach",
            "locations/vermont/south-burlington",
            "locations/new-york/south-hampton",
            "locations/washington/south-hill",
            "locations/texas/south-padre-island",
            "locations/maine/south-portland",
            "locations/mississippi/southaven",
            "locations/north-carolina/southern-shores",
            "locations/florida/space-coast",
            "locations/nevada/sparks",
            "locations/arkansas/springdale",
            "locations/ohio/springfield",
            "locations/florida/st-augustine",
            "locations/minnesota/st-cloud",
            "locations/florida/st-george-island",
            "locations/utah/st-george",
            "locations/pennsylvania/state-college",
            "locations/new-york/staten-island",
            "locations/georgia/statesboro",
            "locations/california/stinson-beach",
            "locations/florida/stuart",
            "locations/south-carolina/sullivans-island",
            "locations/north-carolina/surf-city",
            "locations/california/susanville",
            "locations/nevada/tahoe",
            "locations/florida/tarpon-springs",
            "locations/florida/tavernier",
            "locations/indiana/terre-haute",
            "locations/arkansas/texarkana"
        ),
        "2014-10-17" => array(
            "locations/texas/texas-city",
            "locations/florida/titusville",
            "locations/california/topanga",
            "locations/north-carolina/topsail-island",
            "locations/california/torrey-pines",
            "locations/florida/treasure-coast",
            "locations/new-jersey/trenton",
            "locations/california/trinidad",
            "locations/florida/turtle-shores",
            "locations/alabama/tuscaloosa",
            "locations/idaho/twin-falls",
            "locations/georgia/tybee-island",
            "locations/new-york/utica",
            "locations/georgia/valdosta",
            "locations/california/venice",
            "locations/florida/venice",
            "locations/florida/vero-beach",
            "locations/texas/victoria",
            "locations/florida/vilano-beach",
            "locations/massachusetts/vineyard-haven",
            "locations/hawaii/waipahu",
            "locations/oregon/waldport",
            "locations/rhode-island/warwick",
            "locations/alaska/wasilla",
            "locations/iowa/waterloo",
            "locations/new-york/watertown",
            "locations/south-dakota/watertown",
            "locations/wisconsin/wausau",
            "locations/washington/wenatchee",
            "locations/washington/west-port"
        ),
        "2014-10-18" => array(
            "locations/west-virginia/wheeling",
            "locations/california/whitethorn",
            "locations/pennsylvania/williamsport",
            "locations/ohio/willoughby",
            "locations/delaware/wilmington",
            "locations/virginia/winchester",
            "locations/north-carolina/wrightsville-beach",
            "locations/oregon/yachats",
            "locations/washington/yakima",
            "locations/pennsylvania/york",
            "locations/ohio/youngstown",
            "locations/california/yuba",
            "locations/arizona/yuma",
            "locations/ohio/zanesville"
        )
    );

    public function getReleasedCount() {
        $counts = array();
        foreach($this->_releasedPages as $releaseDate=>$pages) {
            $counts[$releaseDate] = count($pages);
        }
        $counts['total'] = array_sum($counts);
        return $counts;
    }

    public function getReleasedPages() {
        return $this->_releasedPages;
    }

    public function getUnReleasedPages() {
        $pages = Mage::getModel("cms/page")->getCollection();
        $pages->addFieldToFilter('identifier',array("like"=>"locations/%"));
        $identifiers = array();
        foreach($pages as $page) {
            $pageIdentifier = $page->getIdentifier();
            if(!in_array_r($pageIdentifier,$this->_releasedPages)) {
                $identifiers[] = $pageIdentifier;
            }
        }
        return $identifiers;
    }

    public function printUnReleasedArray() {
        $unrel  = $this->getUnReleasedPages();
        for($i=0;$i<count($unrel);$i+=30) {
            echo '"'.date("Y-m-d",strtotime(end(array_keys($this->_releasedPages))." +".(($i/30)+1)."days")).'" => array(<br/>';
            echo '"'.implode('",</br>"',array_slice($unrel,$i,30)).'"<br/>';
            echo "),<br/>";
        }
    }

    public function isActiveByIdentifier($identifier) {
        if($this->_releaseAllPages==true) return true;
        $today = date("Y-m-d");
        $found = false;
        foreach($this->_releasedPages as $releaseDate=>$pages) {
            if(!($releaseDate <= $today)) break;
            $found = $found || in_array($identifier,$pages);
            if($found) break;
        }
        return $found;
    }

    public function checkReleasedPages() {
        $limit = false;
        $today = date("Y-m-d");
        $model = Mage::getModel("cms/page");
        // $store = Mage::app()->getStore()->getStoreId();
        $error = array();
        // $id    = -1;
        // $newid = 0;
        foreach($this->_releasedPages as $releaseDate=>$pages) {
            if($limit) {if(!($releaseDate <= $today)) break;}
            foreach($pages as $identifier) {
                //try {
                //    $newid = $model->load($identifier,'identifier')->getId();
                //} catch(Exception $e) {
                //    $error[$releaseDate][] = $identifier;
                //}
                //if($newid==$id) {
                //    $error[$releaseDate][] = $identifier;
                //} else {
                //    $id = $newid;
                //}
                if(is_null(Mage::getModel("cms/page")->load($identifier,'identifier')->getIdentifier())) {
                    $error[$releaseDate][] = $identifier;
                }
            }
        }
        return $error;
    }

    public function duplicateReleases() {
        $duplicates = array();
        foreach($this->_releasedPages as $releaseDate=>$pages) {
            foreach($pages as $page) {
                foreach($this->_releasedPages as $checkDate=>$checkPages) {
                    if($checkDate == $releaseDate) continue;
                    if(in_array($page,$checkPages)) {
                        $duplicates[$page][] = $checkDate;
                    }
                }
            }
        }
        return $duplicates;
    }

    public function getFlatReleasePages() {
        if(isset($this->_flatReleasedPages)) return $this->_flatReleasedPages;
        $flat = array();
        foreach($this->_releasedPages as $releaseDate => $pages) {
            foreach($pages as $identifier) {
                $flat[] = $identifier;
            }
        }
        $this->_flatReleasedPages = $flat;
        return $this->_flatReleasedPages;
    }

    public function arrValsNotInRelease($idents) {
        $flatReleases = $this->getFlatReleasePages();
        return array_diff($idents,$flatReleases);
    }

    public function releaseNotInArrVals($idents) {
        $flatReleases = $this->getFlatReleasePages();
        return array_diff($flatReleases, $idents);
    }


    public function generateTodaySitemap() {
        $today = date("Y-m-d");
        $todayPages = $this->_releasedPages[$today];
        $newXML = array();
        foreach($todayPages as $page) {
$xml = <<<XML
    <url>
        <loc>http://www.rattanoutdoorfurniture.com/{$page}/</loc>
        <lastmod>{$today}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
XML;
            $newXML[] = htmlspecialchars($xml);
        }
        return implode("<br/>",$newXML);
    }


    public function generateSitemapFromIdentifiers($idents) {
        $today = date("Y-m-d");
        $newXML = array();
        foreach($idents as $page) {
$xml = <<<XML
    <url>
        <loc>http://www.rattanoutdoorfurniture.com/{$page}/</loc>
        <lastmod>{$today}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.8</priority>
    </url>
XML;
            $newXML[] = htmlspecialchars($xml);
        }
        return implode("<br/>",$newXML);
    }

}

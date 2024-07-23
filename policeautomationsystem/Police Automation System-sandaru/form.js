document.addEventListener('DOMContentLoaded', function() {
    const districts = [
        { text:"Ampara"        , value:"Ampara"   },
        { text:"Anuradhapura"  , value:"Anuradhapura"   },
        { text:"Badulla"       , value:"Badulla"   },
        { text:"Batticaloa"    , value:"Batticaloa"   },
        { text:"Colombo"       , value:"Colmbo"   },
        { text:"Galle"         , value:"Galle"   },
        { text:"Gampaha"       , value:"Gampaha"   },
        { text:"Hambantota"    , value:"Hambantota"   },
        { text:"Jaffna"        , value:"Jaffna"   },
        { text:"Kalutara"      , value:"Kalutara"  },
        { text:"Kandy"          , value:"Kandy" },
        { text:"Kegalle"        , value:"Kegalle" },
        { text:"Kilinochchi"    , value:"Kilinochchi" },
        { text:"Kurunegala"     , value:"Kurunagala" },
        { text:"Mannar"         , value:"Mannar" },
        { text:"Matale"         , value:"Matale" },
        { text:"Matara"         , value:"Matara" },
        { text:"Moneragala"     , value:"Monaragala" },
        { text:"Mullaitivu"     , value:"Mullaitivu" },
        { text:"Nuwara Eliya"   , value:"Nuwara Eliya" },
        { text:"Polonnaruwa"    , value:"Polonnaruwa" },
        { text:"Puttalam"       , value:"Puttalam" },
        { text:"Ratnapura"      , value:"Rathnapura" },
        { text:"Trincomalee"    , value:"Trincomalee" },
        { text:"Vavuniya"       , value:"Vavniya" }
    ];

    const policeStations = [
        { text:"Ampara"        , value:"Ampara"   },
        { text:"Anuradhapura"  , value:"Anuradhapura"   },
        { text:"Badulla"       , value:"Badulla"   },
        { text:"Batticaloa"    , value:"Batticaloa"   },
        { text:"Colombo"       , value:"Colombo"   },
        { text:"Galle"         , value:"Galle"   },
        { text:"Gampaha"       , value:"Gampaha"   },
        { text:"Hambantota"    , value:"Hambantota"   },
        { text:"Jaffna"        , value:"Jaffna"   },
        { text:"Kalutara"      , value:"Kalutara"  },
        { text:"Kandy"          , value:"Kandy" },
        { text:"Kegalle"        , value:"Kegalle" },
        { text:"Kilinochchi"    , value:"Kilinochchi" },
        { text:"Kurunegala"     , value:"Kurunagala" },
        { text:"Mannar"         , value:"Mannar" },
        { text:"Matale"         , value:"Matale" },
        { text:"Matara"         , value:"Matara" },
        { text:"Moneragala"     , value:"Monaragala" },
        { text:"Mullaitivu"     , value:"Mulaitivu" },
        { text:"Nuwara Eliya"   , value:"Nuwara Eliya" },
        { text:"Polonnaruwa"    , value:"Polonnaruwa" },
        { text:"Puttalam"       , value:"Puttalam" },
        { text:"Ratnapura"      , value:"Rathnapura" },
        { text:"Trincomalee"    , value:"Trincomalee" },
        { text:"Vavuniya"       , value:"Vavuniya" }
    ];

    const compliant = [
        { text:"Abuse of women or children" , value:"Abuse of women or children"   },
        { text:"Appereciation"              , value:"Appereciation"   },
        { text:"Archeological issue"        , value:"Archeological issue"   },
        { text:"Assault"                    , value:"Assault"   },
        { text:"Bribery and corruption"     , value:"Bribery and corruption"   },
        { text:"Complaint against police"   , value:"Complaint against police"   },
        { text:"Criminal offence"           , value:"Criminal offence"   },
        { text:"Cybercrime"                 , value:"Cybercrime"   },
        { text:"Demonstration"              , value:"Demonstration"   },
        { text:"Environment issue"          , value:"Environment issue"  },
        { text:"Exchange fault"             , value:"Exchange fault" },
        { text:"Foreign employment issue"   , value:"Foreign employment issue" },
        { text:"cheating"                   , value:"cheating" },
        { text:"House breaking"             , value:"House breaking" },
        { text:"Illegal minning"            , value:"Illegal minning" },
        { text:"labour dispute"             , value:"labour dispute" },
        { text:"Information"                , value:"Information" },
        { text:"MIscellaneous"              , value:"MIscellaneous" },
        { text:"Mischeief"                  , value:"Mischeief" },
        { text:"Murder"                     , value:"Murder" },
        { text:"Drugs"                      , value:"Drugs" },
        { text:"National security"          , value:"National security" },
        { text:"Natural Disaster"           , value:"Natural Disaster" },
        { text:"Offence"                    , value:"Offence" },
        { text:"Organized crime"            , value:"Organized crime" },
        { text:"Sexual offence"             , value:"Sexual offence" },
        { text:"Suggention"                 , value:"Suggention" },
        { text:"Treasure hunting"            , value:"Treasure hunting" }
    ];


    const districtSelect = document.getElementById('district');
    const policeStationSelect = document.getElementById('police-station');
    const compliantselect = document.getElementById('complaint-category');
    
    

    districts.forEach(function(district) {
        const option = document.createElement('option');
        option.value = district.value;
        option.textContent = district.text;
        districtSelect.appendChild(option);
    });

    policeStations.forEach(function(station) {
        const option = document.createElement('option');
        option.value = station.value;
        option.textContent = station.text;
        policeStationSelect.appendChild(option);
    });

    compliant.forEach(function(com) {
        const option = document.createElement('option');
        option.value = com.value;
        option.textContent = com.text;
        compliantselect.appendChild(option);
    });



    
});



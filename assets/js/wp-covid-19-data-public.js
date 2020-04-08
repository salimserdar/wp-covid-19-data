(function() {

    const canvasElems = document.getElementsByClassName("wp-covid-19-canvas");

    for (const key in canvasElems) {
        if (canvasElems.hasOwnProperty(key)) {
            const element = canvasElems[key];
            let country = element.getAttribute("data-country");
            let localLanguage = element.getAttribute("data-language");
            getCountryHistorical(country, localLanguage);
        }
    }

    async function getCountryHistorical(country, localLanguage) {
        var response = await fetch(
            "https://corona.lmao.ninja/v2/historical/" + country
        );
        var data = await response.json();
        initLineChart(data, country, localLanguage);
        return data;
    }

    function initLineChart(data, country, localLanguage) {

        const translatedlb = translatedLabels(localLanguage);

        const labels = Object.keys(data.timeline.cases);

        const caseData = Object.values(data.timeline.cases);

        const caseDeaths = Object.values(data.timeline.deaths);

        var config = {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                        label: translatedlb.cases,
                        borderColor: "rgb(54, 162, 235)",
                        data: caseData,
                        fill: false
                    },
                    {
                        label: translatedlb.deaths,
                        borderColor: "rgb(255, 99, 132)",
                        fill: false,
                        data: caseDeaths
                    }
                ]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: country
                },
                tooltips: {
                    mode: "index",
                    intersect: false
                },
                hover: {
                    mode: "nearest",
                    intersect: true
                },
                scales: {
                    x: {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Month"
                        }
                    },
                    y: {
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: "Value"
                        }
                    }
                }
            }
        };

        var ctx = document.getElementById(country).getContext("2d");
        var myLine = new Chart(ctx, config);
    }

    function translatedLabels(localLanguage) {

        if (localLanguage === "tr_TR") {
            const translatedLabels = {
                cases: "Vaka sayısı",
                deaths: "Ölü sayısı"
            };
            return translatedLabels;
        } else {
            const translatedLabels = {
                cases: "Cases",
                deaths: "Deaths"
            };
            return translatedLabels;
        }
    }

})();
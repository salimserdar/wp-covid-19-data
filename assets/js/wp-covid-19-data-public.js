(function() {

  const canvasElems = document.getElementsByClassName("wp-covid-19-canvas");

  for (const key in canvasElems) {
    if (canvasElems.hasOwnProperty(key)) {
      const element = canvasElems[key];
      let country= element.getAttribute("data-country");
      getCountryHistorical(country);
    }
  }

  async function getCountryHistorical(country) {
    var response = await fetch(
      "https://corona.lmao.ninja/v2/historical/" + country
    );
    var data = await response.json();
    initLineChart(data, country);
    return data;
  }

  function initLineChart(data, country) {

    const labels = Object.keys(data.timeline.cases);

    const caseData = Object.values(data.timeline.cases);

    const caseDeaths = Object.values(data.timeline.deaths);

    var config = {
      type: "line",
      data: {
        labels: labels,
        datasets: [
          {
            label: "Cases",
            borderColor: "rgb(255, 99, 132)",
            data: caseData,
            fill: false
          },
          {
            label: "Deaths",
            borderColor: "rgb(54, 162, 235)",
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


})();

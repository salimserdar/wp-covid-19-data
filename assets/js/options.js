export const options = {
    responsive: true,
    title: {
      display: false,
      text: "Chart.js Line Chart"
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
  };
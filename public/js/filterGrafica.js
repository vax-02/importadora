

const ctxSucursal = document.getElementById("sucursales").getContext("2d");


async function getDataForDate(method, date) {
    try {
        const params = new URLSearchParams();
        params.append("date", date);
        const response = await fetch(
            `/ImportadoraFernandez/informe/${method}?date=${date}`,
            {
                method: "GET",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            }
        );
        const data = await response.json();
        return data ? data : "ERROR es retorno";
    } catch (error) {
        console.error("Error mio:", error);
        return "ERROR another";
    }
}
async function grafSucursalesForDate(date) {
    info = await getDataForDate("getSucursalesForDate", date);

    if (myChart) {
        myChart.destroy();
    }

    let labels = "",
        ventas = "";
    try {
        labels = info.map((item) => item["NOMBRE"]);
        ventas = info.map((item) => item["VENTAS"]);
    } catch (e) {
        console.log(e);
    }

    labels = labels.length > 0 ? labels : ["SIN", "VENTAS"];

    ventas = ventas.length > 0 ? ventas : [1, 1];
    //console.log(ventas);

    const data = {
        labels: labels,
        datasets: [
            {
                label: "# Ganancias generadas",
                data: ventas,
                backgroundColor: [
                    "rgba(255, 206, 86, 0.2)",
                    "rgba(75, 192, 192, 0.2)",
                    "rgba(153, 102, 255, 0.2)",
                    "rgba(255, 159, 64, 0.2)",
                ],
                borderColor: [
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(153, 102, 255, 1)",
                    "rgba(255, 159, 64, 1)",
                ],
                borderWidth: 1,
            },
        ],
    };

    const options = {
        responsive: true,
        plugins: {
            legend: {
                display: false, // Ocultar la leyenda del gráfico
            },
        },
    };

    myChart = new Chart(ctxSucursal, {
        type: "pie",
        data: data,
        options: options,
    });

    // Listado de nombres

    const labelsContainer = document.getElementById("labelsContainer");
    labelsContainer.innerHTML = "";
    data.labels.forEach((label, index) => {
        const listItem = document.createElement("div");
        listItem.textContent = `${label}: ${data.datasets[0].data[index]}`;
        labelsContainer.appendChild(listItem);
    });
}


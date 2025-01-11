var myChart;
let chartMarcaTela;

async function getData(method) {
    try {
        const response = await fetch(
            "/ImportadoraFernandez/informe/"+method,
            {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            }
        );
        const data = await response.json();
        return data ? data : "ERROR";
    } catch (error) {
        console.error("Error:", error);
        return "ERROR";
    }
}
async function grafSucursales() {
    info = await getData("getSucursales");
    const ctxSucursales = document
        .getElementById("sucursales")
        .getContext("2d");
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

    myChart = new Chart(ctxSucursales, {
        type: "pie",
        data: data,
        options: options,
    });

    // Listado de nombres

    const labelsContainer = document.getElementById("labelsContainer");

    data.labels.forEach((label, index) => {
        const listItem = document.createElement("div");
        listItem.textContent = `${label}: ${data.datasets[0].data[index]}`;
        labelsContainer.appendChild(listItem);
    });
}
grafSucursales();
//VENDEDORES
async function grafSellers() {
    info = await getData("getPersonalTopFive");
    const ctxVendedores = document
        .getElementById("vendedores")
        .getContext("2d");
    let labels = "",
        ventas = "";
    try {
        labels = info.map((item) => item["PERSONAL"]);
        ventas = info.map((item) => item["VENTASR"]);
    } catch (e) {
        console.log(e);
    }

    labels = labels.length > 0 ? labels : ["SIN", "VENTAS"];

    ventas = ventas.length > 0 ? ventas : [1, 1];

    const data = {
        labels: labels,
        datasets: [
            {
                label: "# Ventas por personal",
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

    const myChart = new Chart(ctxVendedores, {
        type: "pie",
        data: data,
        options: options,
    });

    // Listado de nombres

    const labelsContainer = document.getElementById("labelVendedores");

    data.labels.forEach((label, index) => {
        const listItem = document.createElement("div");
        listItem.textContent = `${label}: ${data.datasets[0].data[index]}`;
        labelsContainer.appendChild(listItem);
    });
}
grafSellers();

//TELAS
async function grafTelas() {
    const ctx = document.getElementById("telasColores");
    info = await getData("getSellTelas");
  
    let labels = "",
        ventas = "";
    try {
        labels = info.map((item) => item["NOMBRE"]);
        ventas = info.map((item) => item["METROS"]);
    } catch (e) {
        console.log(e);
    }

    labels = labels.length > 0 ? labels : ["SIN", "DATOS"];

    ventas = ventas.length > 0 ? ventas : [1, 1];


    chartMarcaTela = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Telas",
                    data: ventas,
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

grafTelas();

//MARCAS
async function grafMarcas() {
    const ctx = document.getElementById("telasColores");
    info = await getData("getSellMarcas");
  
    let labelsMarca = "",
        ventasMarca = "";
    try {
        labelsMarca = info.map((item) => item["DESCRIPCION"]);
        ventasMarca = info.map((item) => item["METROS"]);
    } catch (e) {
        console.log(e);
    }
    labelsMarca = labelsMarca.length > 0 ? labelsMarca : ["SIN", "DATOS"];

    ventasMarca = ventasMarca.length > 0 ? ventasMarca : [1, 1];

   
    chartMarcaTela = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labelsMarca,

            datasets: [
                {
                    label: "Marca",
                    data: ventasMarca,
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
}

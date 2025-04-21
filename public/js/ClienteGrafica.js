const InputWeek = document.getElementById("week");
const InputMonth = document.getElementById("month");

const datePersonal = document.getElementById("dateCompraClientes");
const link = document.getElementById("compraClientesToExcel");
const currentHref = new URL(link.href);


datePersonal.addEventListener("change", async function () {
  grafClientesForDate(this.value)

  currentHref.searchParams.set("type", 1);
  currentHref.searchParams.set("date", this.value);
  link.href = currentHref.toString();
});

//Type de filtrado
document.getElementById("typeFilter").addEventListener("input", function () {
  console.log("here");
  switch (this.value) {
    case "1":
      datePersonal.classList.remove("d-none");
      InputWeek.classList.add("d-none");
      InputMonth.classList.add("d-none");
      break;
    case "2":
      InputWeek.classList.remove("d-none");
      datePersonal.classList.add("d-none");
      InputMonth.classList.add("d-none");
      break;
    case "3":
      InputMonth.classList.remove("d-none");
      InputWeek.classList.add("d-none");
      datePersonal.classList.add("d-none");
  }
});

InputMonth.addEventListener("change", function () {
  const [year, month] = this.value.split("-");
  grafForMonth(year, month);

  currentHref.searchParams.set("type", 3);
  currentHref.searchParams.set("month", month);
  currentHref.searchParams.set("year", year);
  link.href = currentHref.toString();
});

InputWeek.addEventListener("change", function () {
  const [year, week] = this.value.split("-W"); // Separar el año y el número de semana
  const weekNumber = parseInt(week, 10);
  const firstDayOfYear = new Date(year, 0, 1);

  const daysOffset = (weekNumber - 1) * 7 - (firstDayOfYear.getDay() || 7) + 1;
  const startOfWeek = new Date(
    firstDayOfYear.setDate(firstDayOfYear.getDate() + daysOffset)
  );

  // Calcular el fin de la semana (7 días después del inicio)
  const endOfWeek = new Date(startOfWeek);
  endOfWeek.setDate(startOfWeek.getDate() + 6); // Sumar 6 días para obtener el fin de la semana

  // Formatear las fechas de inicio y fin
  const startDate = convertirFecha(formatDate(startOfWeek));
  const endDate = convertirFecha(formatDate(endOfWeek));

  //
  grafForWeek(startDate, endDate);

  currentHref.searchParams.set("type", 2);
  currentHref.searchParams.set("inicio", startDate);
  currentHref.searchParams.set("fin", endDate);
  link.href = currentHref.toString();
});

function formatDate(date) {
  const day = String(date.getDate()).padStart(2, "0");
  const month = String(date.getMonth() + 1).padStart(2, "0"); // Los meses son 0-indexados
  const year = date.getFullYear();
  return `${day}/${month}/${year}`;
}
async function getForWeek(startDate, endDate) {
  try {
    const params = new URLSearchParams();
    params.append("inicio", startDate);
    params.append("fin", endDate);
    const response = await fetch(
      `/ImportadoraFernandez/informe/informeClientesForWeek?inicio=${startDate}&fin=${endDate}`,
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
async function grafForWeek(inicio, fin) {
  info = await getForWeek(inicio, fin);
  console.log(info);

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

  const labelsContainer = document.getElementById("labelsClientes");
  labelsContainer.innerHTML = "";
  data.labels.forEach((label, index) => {
    const listItem = document.createElement("div");
    listItem.textContent = `${label}: ${data.datasets[0].data[index]}`;
    labelsContainer.appendChild(listItem);
  });
}

async function getForMonth(year, month) {
  try {
    const params = new URLSearchParams();
    params.append("year", year);
    params.append("month", month);
    const response = await fetch(
      `/ImportadoraFernandez/informe/informeClientesForMonth?year=${year}&month=${month}`,
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

async function grafForMonth(year, month) {
  info = await getForMonth(year, month);
  //console.log(info);

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
  const labelsContainer = document.getElementById("labelsClientes");
  labelsContainer.innerHTML = "";
  data.labels.forEach((label, index) => {
    const listItem = document.createElement("div");
    listItem.textContent = `${label}: ${data.datasets[0].data[index]}`;
    labelsContainer.appendChild(listItem);
  });
}

function convertirFecha(fecha) {
  const partes = fecha.split("/"); // Divide la fecha en partes: [DD, MM, YYYY]
  return `${partes[2]}-${partes[1]}-${partes[0]}`; // Devuelve la fecha en formato YYYY-MM-DD
}

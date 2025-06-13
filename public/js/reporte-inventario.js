document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('graficoMateriasPrimas');
    
    if (canvas) {
        try {
            const datos = JSON.parse(canvas.getAttribute('data-materias') || '[]');

            if (datos.length > 0) {
                const etiquetas = datos.map(item => item.nombre_materia_prima);
                const valores = datos.map(item => item.cantidad_total_usada);
                
                const colores = datos.map(() => {
                    const r = Math.floor(Math.random() * 255);
                    const g = Math.floor(Math.random() * 255);
                    const b = Math.floor(Math.random() * 255);
                    return `rgba(${r}, ${g}, ${b}, 0.7)`;
                });

                const ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: etiquetas,
                        datasets: [{
                            label: 'Cantidad Total Usada',
                            data: valores,
                            backgroundColor: colores,
                            borderColor: colores.map(color => color.replace('0.7', '1')),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top' },
                            title: {
                                display: true,
                                text: 'Uso Total de Materias Primas',
                                font: { size: 18 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: { display: true, text: 'Cantidad Usada' },
                                ticks: { precision: 0 }
                            },
                            x: {
                                title: { display: true, text: 'Materia Prima' }
                            }
                        }
                    }
                });
            }
        } catch (error) {
            console.error("Error al crear el gráfico:", error);
            canvas.parentNode.innerHTML = `<div class="alert alert-danger">Error al crear el gráfico: ${error.message}</div>`;
        }
    }
});

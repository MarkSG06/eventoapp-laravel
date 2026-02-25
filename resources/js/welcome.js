const data = [
  {
    image: 'https://picsum.photos/300/140?random=1',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=2',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=3',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=4',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=5',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=6',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=7',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=8',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=9',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=10',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=11',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },
  {
    image: 'https://picsum.photos/300/140?random=12',
    titulo: 'Jam Session Santa Maria',
    fecha: {
      dia: 'Miércoles 14 de Enero',
      hora: '20:00'
    },
    lugar: {
      lugar: 'La Movida Café-Concierto',
      direccion: 'Calle Mayor, 123'
    }
  },

]

const eventosContainer = document.querySelector('.eventos')

data.forEach(events =>
{
  const eventoContainer = document.createElement('div')
  eventoContainer.classList.add('evento')
  eventosContainer.appendChild(eventoContainer)

  const eventImage = document.createElement('div')
  eventImage.classList.add('event-image')
  eventoContainer.appendChild(eventImage)

  const eventImageImg = document.createElement('img')
  eventImageImg.src = events.image
  eventImage.appendChild(eventImageImg)

  const titulo = document.createElement('div')
  titulo.classList.add('titulo')
  eventoContainer.appendChild(titulo)

  const tituloTitulo = document.createElement('h2')
  tituloTitulo.textContent = events.titulo
  titulo.appendChild(tituloTitulo)

  const fecha = document.createElement('div')
  fecha.classList.add('fecha')
  eventoContainer.appendChild(fecha)

  const fechaDia = document.createElement('span')
  fechaDia.textContent = events.fecha.dia
  fecha.appendChild(fechaDia)

  const fechaHora = document.createElement('p')
  fechaHora.textContent = events.fecha.hora
  fecha.appendChild(fechaHora)

  const lugar = document.createElement('div')
  lugar.classList.add('lugar')
  eventoContainer.appendChild(lugar)

  const lugarLugar = document.createElement('p')
  lugarLugar.textContent = events.lugar.lugar
  lugar.appendChild(lugarLugar)

  const lugarDireccion = document.createElement('p')
  lugarDireccion.textContent = events.lugar.direccion
  lugar.appendChild(lugarDireccion)

})

const menu = document.querySelector('.menu');
const menuOptions = document.querySelector('.menu-options');
menu.addEventListener('click', () =>
{
  menuOptions.classList.toggle('active');
})
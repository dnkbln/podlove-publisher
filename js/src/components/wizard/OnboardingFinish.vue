<template>
  <div class="root">
    <h2> Diese Daten werden an den Podlove Publisher übergeben. </h2>
    <div class="item flex items-center">
      <table>
        <tr>
          <th> </th> <th> Deine Eingabe </th>
        </tr>
        <tr>
          <td> Podcast Titel </td> <td> {{$store.getters.title}} </td>
        </tr>
        <tr>
          <td> Untertitel </td> <td> {{$store.getters.subtitle}} </td>
        </tr>
        <tr>
          <td> Zusammenfassung </td> <td> {{$store.getters.summary}} </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
    }
  }
}
</script>

<style scoped>

table {
  max-width: 100%;
}

tr:nth-child(odd) {
  background-color: #eee;
}

th {
  background-color: #555;
  color: #fff;
}

th,
td {
  text-align: left;
  padding: 0.5em 1em;
}

</style>
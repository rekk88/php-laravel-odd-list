<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item" v-for="(link,index) in menu" :key="index">
            <router-link :to="{name: link.routeName}" class="nav-link">
              {{link.label}}
            </router-link>
            <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
      </div>
    </div>
</nav>
</template>

<script>
export default {
  name:"Header",
  data() {
    return {
      menu: [
        {
          label:'Home',
          routeName:'home'
        },
        {
          label:'About',
          routeName:'about'
        },
        {
          label:'Contatti',
          routeName:'contact'
        },
        {
          label:'I miei Post',
          routeName:'post'
        }
      ],
    }
  },
}
</script>

<style>

</style>
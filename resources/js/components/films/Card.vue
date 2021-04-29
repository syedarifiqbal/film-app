<template>
  <div class="box-wrapper">
    <img :src="film.photo" :alt="film.name" />
    <div class="box-content px-3">
      <router-link :to="{name: 'films.edit', params: {slug: film.slug}}" class="buy" href="javascript:void(0)"
        ><span><i class="fa fa-eye"></i></span
      ></router-link>
      <div class="title text-truncate" v-text="film.name"></div>
      <div class="desc text-truncate" v-text="film.description"></div>
      <span class="price">${{ film.ticket_price }}</span>
      <footer>
        <div class="footer d-flex justify-content-center">
          <div class="position-relative">
            <ul class="bg-gray">
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
            </ul>
            <ul
              class="position-absolute"
              :style="{ width: `${ratingPercentage}%` }"
            >
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
              <li class="fa fa-star"></li>
            </ul>
          </div>
        </div>
        <comments :filmId="film.id" />
      </footer>
    </div>
    <div class="success"></div>
  </div>
</template>

<script>
import Comments from "./comments/Index";

export default {
  components: { Comments },
  props: ["film"],
  computed: {
    ratingPercentage() {
      return Number(this.film.rating) * 20;
    },
  },
};
</script>

<style lang=scss>
ul.position-absolute {
  white-space: nowrap;
  overflow: hidden;
  top: 0;
  left: 0;
}

.box-content .footer ul.bg-gray li {
  color: #ccc;
}

.box-wrapper {
  background-color: #fff;
  overflow: hidden;
  max-width: 320px;
  box-shadow: 0px 5px 43px rgba(0, 0, 0, 0.48);
  padding: 0;
  text-align: center;

  img {
    max-width: 100%;
  }

  .success {
    position: absolute;
    top: 50%;
    left: 37%;
    transform: translate(-50%, -50%);
    opacity: 0;
    z-index: 999;

    .expanded & {
      opacity: 1;
      transition: opacity 0.3s 0.6s;
    }

    &:before,
    &:after {
      content: "";
      display: block;
      position: absolute;
      background-color: #fff;
    }

    &:before {
      width: 40px;
      height: 20px;
      transform: rotate(45deg);
    }

    &:after {
      width: 88px;
      height: 20px;
      transform: rotate(-45deg);
      top: -16px;
      left: 8px;
    }
  }
}

.title {
  font-size: 2em;
  font-weight: 900;
  text-transform: uppercase;
  margin: 0;
  font-family: "Acme", sans-serif;
}

.desc {
  font-family: "Satisfy", cursive;
  font-size: 1.2em;
}

.box-content {
  position: relative;
  z-index: 1;

  &:before {
    content: "";
    width: 200%;
    height: 100px;
    position: absolute;
    display: block;
    background-color: #fff;
    transform: rotate(-8deg);
    top: -50px;
    left: -10%;
    z-index: -1;
  }

  .buy {
    display: block;
    top: -80px;
    right: 30px;
    z-index: 2;
    width: 70px;
    height: 70px;
    position: absolute;

    span {
      width: 70px;
      height: 70px;
      background-color: #06d6a0;
      display: block;
      border-radius: 50%;
      position: absolute;
      font-size: 36px;
      color: #fff;
      transition: all 0.3s ease;
      transform: translate(-50%, -50%);
      top: 50%;
      left: 50%;

      i {
        padding: 15px;
      }

      .expanded & {
        width: 750px;
        height: 750px;

        i {
          display: none;
        }
      }
    }
  }

  .price {
    font-size: 2em;
    font-weight: 900;
    display: block;
    width: 100px;
    margin: 20px auto 0;
    position: relative;
    font-family: "Satisfy", cursive;

    &:after,
    &:before {
      content: "";
      height: 1px;
      width: 50px;
      display: block;
      position: absolute;
      background-color: #ddd;
      top: 18px;
    }

    &:before {
      left: -50px;
    }

    &:after {
      right: -50px;
    }
  }

  .footer {
    ul {
      list-style: none;
      padding: 0;
      margin: 1em 0;

      li {
        color: #efd829;
      }
    }
  }
}
</style>


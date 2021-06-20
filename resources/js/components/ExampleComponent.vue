<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            Example Component
          </div>
          <p>Message: {{ message }}</p>
          <p>Message: {{ reversedMessage }}</p>

          <div class="card-body">
            I'm an example component.
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      message: "hello"
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  computed: {
    reversedMessage: function() {
      return this.message
        .split("")
        .reverse()
        .join("");
    }
  }
};
</script>

<template >

</template>
<script>
export default {
	beforeMount(){
			this.$store.commit("setToken", null);
			this.$router.push("");
	}
}
</script>

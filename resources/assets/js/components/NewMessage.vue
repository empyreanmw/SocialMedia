<script>
export default {
	data(){
		return {
			receiverField: '',
			receiver: this.receiver
		};
	},

	methods: 
	{
		setReceiver(name)
		{
			this.receiverField = name;
		}
	}
}
</script>
<template>
	<el-col :span="12" :offset="6">
		<h2 style="text-align: center">Register</h2>
		<hr>
		<el-form size="medium" label-position="left" :model="ruleForm2" status-icon ref="ruleForm2" label-width="120px" class="demo-ruleForm">
			<el-form-item
				label-width="200px"
			    prop="username"
			    label="Username"
			    :rules="[
			      { required: true, message: 'Please input username', trigger: 'blur' }
			    ]"
			  >
			    <el-input v-model="ruleForm2.username"></el-input>
			</el-form-item>
			<el-form-item
				label-width="200px"
			    prop="email"
			    label="Email"
			    :rules="[
			      { required: true, message: 'Please input email', trigger: 'blur' },
			      { type: 'email', message: 'Please input correct email address', trigger: ['blur', 'change'] }
			    ]"
			  >
			    <el-input v-model="ruleForm2.email"></el-input>
			</el-form-item>
			<el-form-item
				label-width="200px" 
				label="Password" 
				prop="password"
				:rules="[
					{required: true, message: 'Please input the password', trigger: 'blur'}
				]">
				<el-input type="password" v-model="ruleForm2.password" autocomplete="off"></el-input>
			</el-form-item>
			<el-form-item
				label-width="200px" 
				label="Confirm Password" 
				prop="cPassword"
				:rules="[
					{required: true, trigger: 'blur', validator: checkConfirm}
				]">
				<el-input type="password" v-model="ruleForm2.cPassword" autocomplete="off"></el-input>
			</el-form-item>
			<el-form-item label-width="200px" >
				<small><router-link to="/login"><el-button type="text" >i have an account</el-button></router-link></small>
				<el-button style="float: right" type="info" @click="submitForm('ruleForm2')">Sign up</el-button>
			</el-form-item>
		</el-form>
	</el-col>	
</template>
<script>
	import { Col, Form, FormItem, Input, Button, Notification } from 'element-ui'
	export default {
		components:{
			'el-col': Col,
			'el-form': Form,
			'el-form-item': FormItem,
			'el-input': Input,
			'el-button': Button,
		},
    	data() {
			var validateUsername = (rule, value, callback) => {
				if (value === '') {
					callback(new Error('Please input the username'));
				} else {
					callback();
				}
			};
			var validatePass2 = (rule, value, callback) => {
				if (value === '') {
					callback(new Error('Please input the password'));
				} else {
					callback();
				}
			};
			return {
				ruleForm2: {
					email: 'anaselalamikh@gmail.com',
					username: 'khofaai',
					password: '123456',
					cPassword:'123456'
				}
			};
		},
		methods: {
			register() {

				axios.post('register',{
					name:this.ruleForm2.username,
					email:this.ruleForm2.email,
					password:this.ruleForm2.password,
					password_confirmation:this.ruleForm2.cPassword
				}).then((resp) => {
					if (resp.status == 200) {
						Notification.success({
							title:"Success",
							message:'account created successfully',
							type:"success"
						});
						this.$router.push('/login');
					}
				}).catch( err => {
					console.error(err)
				});
			},
			submitForm(formName) {

				this.$refs[formName].validate((valid) => {
					if (valid) {
						this.register();
					} else {

						return false;
					}
				});
			},
			checkConfirm (rule, value, callback) {
				if (value === '') {
		          callback(new Error('Please input the password again'));
		        } else if (value !== this.ruleForm2.password) {
		          callback(new Error('Two inputs don\'t match!'));
		        } else {
		          callback();
		        }
			}
		}
  	}
</script>
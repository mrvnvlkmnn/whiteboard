let actions = {
    fetchPosts({commit}) {
        axios.get('/api/surveys')
            .then(res => {
                commit('FETCH_SURVEYS', res.data)
            }).catch(err => {
            console.log(err)
        })
    }
}

export default actions

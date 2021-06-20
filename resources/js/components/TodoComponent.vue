<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      app
    />
    <v-app-bar app>
      <v-app-bar-nav-icon @click="drawer = !drawer" />
      <v-toolbar-title>Todo Apps</v-toolbar-title>
    </v-app-bar>

    <v-main>
      <v-container>
        <v-data-table
          :headers="headers"
          :items="items"
          :items-per-page="15"
          class="elevation-1"
        >
          <template #top>
            <v-toolbar flat>
              <v-toolbar-title>Todo List</v-toolbar-title>
              <v-spacer />
              <v-dialog
                v-model="dialog"
                max-width="500px"
              >
                <template #activator="{ on, attr }">
                  <v-btn
                    color="primary"
                    dark
                    class="mb-2"
                    v-bind="attr"
                    v-on="on"
                  >
                    New Item
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="text-h5">{{ formTitle }}</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-row v-if="editIndex !== -1">
                        <v-col>
                          <v-text-field
                            v-model="editedItem.id"
                            label="ID"
                            readonly
                          />
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <v-text-field
                            v-model="editedItem.todoName"
                            label="タスク名"
                          />
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <v-textarea
                            outlined
                            v-model="editedItem.todoDetail"
                            label="タスク詳細"
                          />
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col>
                          <v-text-field
                            v-model="editedItem.expire"
                            label="期限"
                            type="date"
                          />
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer />
                    <v-btn @click="dialogClose">
                      Cancel
                    </v-btn>
                    <v-btn @click="save">
                      Save
                    </v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>
          </template>
          <template #[`item.action`]="{ item }">
            <v-icon
              small
              class="mr-2"
              @click="editItem(item)"
            >
              mdi-pencil
            </v-icon>
            <v-icon
              small
              class="mr-2"
            >
              mdi-delete
            </v-icon>
          </template>
        </v-data-table>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    dialog: false,
    headers: [
      {
        text: "id",
        value: "id",
      },
      {
        text: "タスク名",
        value: "todoName",
      },
      {
        text: "期限",
        value: "expire",
      },
      {
        text: "アクション",
        value: "action",
      },
    ],
    items: [],
    editIndex: -1,
    defaultItem: {
      id: "",
      todoName: "",
      todoDetail: "",
      expire: "",
    },
    editedItem: {
      id: "",
      todoName: "",
      todoDetail: "",
      expire: "",
    },
  }),
  computed: {
    formTitle() {
      return this.editIndex === -1 ? "New Item" : "Edit Item";
    },
  },
  created() {
    this.fetchTodos();
  },
  methods: {
    dialogClose() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editIndex = -1;
      });
    },
    editItem(item) {
      this.editIndex = this.items.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
    },
    save() {
      if (this.editIndex === -1) {
        this.axios
          .post("/api/todo", {
            todo_name: this.editedItem.todoName,
            todo_detail: this.editedItem.todoDetail,
            expire: this.editedItem.expire,
          })
          .then(() => {
            this.$router.go({
              path: this.$router.currentRoute.path,
              force: true,
            });
          })
          .catch((err) => {
            console.log(err);
            alert("Save task failed.");
          });
      } else {
        this.axios
          .put(`/api/todo/${this.editedItem.id}`, {
            todo_name: this.editedItem.todoName,
            todo_detail: this.editedItem.todoDetail,
            expire: this.editedItem.expire,
          })
          .then(() => {
            location.reload();
          })
          .catch((err) => {
            console.log(err);
            alert("Update task failed.");
          });
      }
    },
    async fetchTodos() {
      const response = await this.axios.get("/api/todo");
      const todos = response.data.todos;
      todos.forEach((todo) => {
        this.items.push({
          id: todo.id,
          todoName: todo.todo_name,
          todoDetail: todo.todo_detail,
          expire: todo.expire,
        });
      });
    },
  },
};
</script>

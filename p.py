import tkinter as tk

class TodoApp:
    def __init__(self, master):
        self.master = master
        master.title("Aplikasi Pengelola Tugas")

        # Entry untuk input tugas
        self.task_entry = tk.Entry(master, width=40)
        self.task_entry.pack(pady=10)

        # Tombol tambah tugas
        self.add_button = tk.Button(master, text="Tambah Tugas", command=self.add_task)
        self.add_button.pack()

        # Listbox untuk menampilkan tugas
        self.task_list = tk.Listbox(master, width=50)
        self.task_list.pack(pady=10)

        # Tombol hapus tugas
        self.delete_button = tk.Button(master, text="Hapus Tugas", command=self.delete_task)
        self.delete_button.pack()

    def add_task(self):
        # Event handler untuk menambah tugas
        task = self.task_entry.get()
        if task:
            self.task_list.insert(tk.END, task)
            self.task_entry.delete(0, tk.END)

    def delete_task(self):
        # Event handler untuk menghapus tugas
        try:
            index = self.task_list.curselection()[0]
            self.task_list.delete(index)
        except IndexError:
            pass

root = tk.Tk()
todo_app = TodoApp(root)
root.mainloop()
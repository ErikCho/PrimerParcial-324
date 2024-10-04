using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Text;
using System.Windows.Forms;
using System.Data.Odbc;

namespace WindowsFormsApplication3
{
    public partial class Form1 : Form
    {
        DataSet ds = new DataSet();

        private void datos()
        {
            // Cadena de conexión sin DSN
            string connectionString = "Driver={MySQL ODBC 8.0 ANSI Driver};Server=localhost;Database=BDErik;User=root;Password=;";

            using (OdbcConnection con = new OdbcConnection(connectionString))
            {
                con.Open(); // Abre la conexión

                OdbcDataAdapter ada = new OdbcDataAdapter();

                // Primer conjunto de datos: tabla persona
                ada.SelectCommand = new OdbcCommand("SELECT * FROM persona", con);
                ada.Fill(ds, "persona");

                // Segundo conjunto de datos: tabla catastro
                ada.SelectCommand.CommandText = "SELECT * FROM catastro";
                ada.Fill(ds, "catastro");
            }
        }

        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            datos();
            dataGridView1.CellValueChanged += dataGridView1_CellValueChanged; // Asignar evento
            dataGridView1.CellValueChanged += dataGridView1_CellValueChangedPersona;
        }

        private void button1_Click(object sender, EventArgs e)
        {
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember= "persona";
            dataGridView1.CellValueChanged -= dataGridView1_CellValueChanged; // Desasignar evento catastro
        }

        private void button2_Click(object sender, EventArgs e)
        {
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "catastro";
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Form2 f = new Form2();
            f.ShowDialog();
            datos();
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "catastro";
        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
            textBox2.Text = e.RowIndex.ToString();
        }

        private void button4_Click(object sender, EventArgs e)
        {
            DataRow dr = ds.Tables[0].Rows[0];
            textBox1.Text = dr["ci"].ToString();
            textBox2.Text = ds.Tables[0].Rows.Count.ToString();
        }

        private void dataGridView1_CellClick(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0 && e.ColumnIndex >= 0)
            {
                // Obtener el índice de la tabla
                DataRow dr = ds.Tables[1].Rows[e.RowIndex];

                // Asignar los valores a los TextBox
                textBox2.Text = e.RowIndex.ToString();
                textBox3.Text = dr["id"].ToString();
                textBox4.Text = dr["zona"].ToString();
            }
        }

        private void button5_Click(object sender, EventArgs e)
        {
            SqlConnection con = new SqlConnection();
            con.ConnectionString = "server=(local);database=BDErik;Integrated Security=True;";

            SqlCommand cmd = new SqlCommand();
            cmd.Connection = con;
            cmd.CommandText = "UPDATE catastro SET zona=@zona, x_inicio=@x_inicio, y_inicio=@y_inicio, x_fin=@x_fin, y_fin=@y_fin, superficie=@superficie, ci=@ci, distrito=@distrito WHERE codigo=@codigo";
            cmd.Parameters.AddWithValue("@codigo", textBox3.Text);
            cmd.Parameters.AddWithValue("@zona", textBox4.Text);


            // Abrir la conexión, ejecutar el comando y cerrarla
            con.Open();
            cmd.ExecuteNonQuery();
            con.Close();

            datos();

            // Actualizar el DataGridView con los nuevos datos
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "catastro";
        }
        private void dataGridView1_CellValueChanged(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0 && e.ColumnIndex >= 0)
            {
                string id = dataGridView1.Rows[e.RowIndex].Cells["id"].Value.ToString();
                string zona = dataGridView1.Rows[e.RowIndex].Cells["zona"].Value.ToString();
                float x_inicio = float.Parse(dataGridView1.Rows[e.RowIndex].Cells["x_inicio"].Value.ToString());
                float y_inicio = float.Parse(dataGridView1.Rows[e.RowIndex].Cells["y_inicio"].Value.ToString());
                float x_fin = float.Parse(dataGridView1.Rows[e.RowIndex].Cells["x_fin"].Value.ToString());
                float y_fin = float.Parse(dataGridView1.Rows[e.RowIndex].Cells["y_fin"].Value.ToString());
                float superficie = float.Parse(dataGridView1.Rows[e.RowIndex].Cells["superficie"].Value.ToString());
                string ci = dataGridView1.Rows[e.RowIndex].Cells["ci"].Value.ToString();
                string distrito = dataGridView1.Rows[e.RowIndex].Cells["distrito"].Value.ToString();

                // Actualizar la base de datos
                using (SqlConnection con = new SqlConnection("server=(local);database=BDErik;Integrated Security=True;"))
                {
                    string query = "UPDATE catastro SET zona=@zona, x_inicio=@x_inicio, y_inicio=@y_inicio, x_fin=@x_fin, y_fin=@y_fin, superficie=@superficie, ci=@ci, distrito=@distrito WHERE id=@id";
                    using (SqlCommand cmd = new SqlCommand(query, con))
                    {
                        cmd.Parameters.AddWithValue("@zona", zona);
                        cmd.Parameters.AddWithValue("@x_inicio", x_inicio);
                        cmd.Parameters.AddWithValue("@y_inicio", y_inicio);
                        cmd.Parameters.AddWithValue("@x_fin", x_fin);
                        cmd.Parameters.AddWithValue("@y_fin", y_fin);
                        cmd.Parameters.AddWithValue("@superficie", superficie);
                        cmd.Parameters.AddWithValue("@ci", ci);
                        cmd.Parameters.AddWithValue("@distrito", distrito);
                        cmd.Parameters.AddWithValue("@id", id);

                        con.Open();
                        cmd.ExecuteNonQuery();
                    }
                }
            }
        }

        private void button6_Click(object sender, EventArgs e)
        {
            Form3 f = new Form3();
            f.ShowDialog();
            datos();
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "persona";
            dataGridView1.CellValueChanged -= dataGridView1_CellValueChanged; // Desasignar evento catastro
            dataGridView1.CellValueChanged += dataGridView1_CellValueChangedPersona; // Asignar evento persona
        }
        private void dataGridView1_CellValueChangedPersona(object sender, DataGridViewCellEventArgs e)
        {
            if (e.RowIndex >= 0 && e.ColumnIndex >= 0 && dataGridView1.DataMember == "persona")
            {
                string ci = dataGridView1.Rows[e.RowIndex].Cells["ci"].Value.ToString();
                string nombre = dataGridView1.Rows[e.RowIndex].Cells["nombre"].Value.ToString();
                string paterno = dataGridView1.Rows[e.RowIndex].Cells["paterno"].Value.ToString();
                string materno = dataGridView1.Rows[e.RowIndex].Cells["materno"].Value.ToString();
                string contraseña = dataGridView1.Rows[e.RowIndex].Cells["contraseña"].Value.ToString();
                string tipopersona = dataGridView1.Rows[e.RowIndex].Cells["tipopersona"].Value.ToString();

                // Actualizar la base de datos
                using (SqlConnection con = new SqlConnection("server=(local);database=BDErik;Integrated Security=True;"))
                {
                    string query = "UPDATE persona SET nombre=@nombre, paterno=@paterno, materno=@materno, contraseña=@contraseña, tipopersona=@tipopersona WHERE ci=@ci";
                    using (SqlCommand cmd = new SqlCommand(query, con))
                    {
                        cmd.Parameters.AddWithValue("@ci", ci);
                        cmd.Parameters.AddWithValue("@nombre", nombre);
                        cmd.Parameters.AddWithValue("@paterno", paterno);
                        cmd.Parameters.AddWithValue("@materno", materno);
                        cmd.Parameters.AddWithValue("@contraseña", contraseña);
                        cmd.Parameters.AddWithValue("@tipopersona", tipopersona);

                        con.Open();
                        cmd.ExecuteNonQuery();
                    }
                }
            }
        }

        private void button7_Click(object sender, EventArgs e)
        {
            // Verifica si hay una fila seleccionada
            if (dataGridView1.SelectedRows.Count > 0)
            {
                // Obtiene el índice de la fila seleccionada
                int rowIndex = dataGridView1.SelectedRows[0].Index;

                // Determina el DataMember actual
                if (dataGridView1.DataMember == "persona")
                {
                    // Obtiene el CI de la fila seleccionada
                    string ci = dataGridView1.Rows[rowIndex].Cells["ci"].Value.ToString();

                    // Ejecuta la consulta de eliminación
                    using (SqlConnection con = new SqlConnection("server=(local);database=BDErik;Integrated Security=True;"))
                    {
                        string query = "DELETE FROM persona WHERE ci=@ci";
                        using (SqlCommand cmd = new SqlCommand(query, con))
                        {
                            cmd.Parameters.AddWithValue("@ci", ci);
                            con.Open();
                            cmd.ExecuteNonQuery();
                        }
                    }
                }
                else if (dataGridView1.DataMember == "catastro")
                {
                    // Obtiene el ID de la fila seleccionada
                    string id = dataGridView1.Rows[rowIndex].Cells["id"].Value.ToString();

                    // Ejecuta la consulta de eliminación
                    using (SqlConnection con = new SqlConnection("server=(local);database=BDErik;Integrated Security=True;"))
                    {
                        string query = "DELETE FROM catastro WHERE id=@id";
                        using (SqlCommand cmd = new SqlCommand(query, con))
                        {
                            cmd.Parameters.AddWithValue("@id", id);
                            con.Open();
                            cmd.ExecuteNonQuery();
                        }
                    }
                }

                // Vuelve a cargar los datos para actualizar el DataGridView
                datos();
            }
            else
            {
                MessageBox.Show("Por favor, seleccione una fila para eliminar.");
            }
        }
    }
}

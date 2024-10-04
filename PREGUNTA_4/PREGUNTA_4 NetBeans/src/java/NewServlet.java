/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/JSP_Servlet/Servlet.java to edit this template
 */

import java.io.IOException;
import java.io.PrintWriter;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Erik
 */
public class NewServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        try {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<meta charset='utf-8'>");
            out.println("<title>Generador de Números</title>");
            out.println("<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>");
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>SERVLET</h1>");

            // Formulario para ingresar cantidad
            out.println("<form method='get' action=''>");
            out.println("<input type='text' value='' name='cantidad' >"); //placeholder='Ingrese cantidad'
            out.println("<input type='submit' value='enviar' name='enviar'>");
            out.println("</form>");

            // Lógica para mostrar números si se envió el formulario
            String cantidadStr = request.getParameter("cantidad");
            if (cantidadStr != null && !cantidadStr.isEmpty()) {
                try {
                    int cantidad = Integer.parseInt(cantidadStr);
                    if (cantidad > 0) {
                        out.println("<h2>NUMEROS:</h2>");
                        
                        // Tabla para mostrar los números
                        out.println("<table class='table table-sm table-dark'>");
                        out.println("<tbody>");
                        for (int i = 1; i <= cantidad; i++) {
                            out.println("<tr><td>" + i + "</td></tr>");
                        }
                        out.println("</tbody>");
                        out.println("</table>");
                    }
                } catch (NumberFormatException e) {
                    out.println("<p style='color:red;'>Por favor, ingrese un número válido.</p>");
                }
            }
            //final aqui
            //out.println("<form method='get' action='http://localhost/324/miphp3.php'>");
            out.println("<input type='text' value='' name='cantidad'>");
            out.println("<input type='submit' value='enviar' name='enviar'>");
            
            out.println("</body>");
            out.println("</html>");
        } finally{
            out.close();
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        processRequest(request, response);
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

}
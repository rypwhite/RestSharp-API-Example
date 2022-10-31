using RestSharp;

class Program
{
    public static void Main(string[] args)
    {
        var client = new RestClient("localhost");

        var request = new RestRequest("api/check_user.php");

        request.AddHeader("User-Agent", "C# Program");
        request.AddHeader("x-api-key", "0f80631b-0145-4d77-ab70-c1e845063cc3");
        request.AddHeader("Content-Type", "application/json");
        request.AddHeader("Accept", "application/json");

        request.Method = Method.Get;
        request.AddParameter("username", "username");

        var response = client.Execute(request);

        Console.WriteLine(response.Content);
    }
}

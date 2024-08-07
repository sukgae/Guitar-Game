using System.Collections;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;

public class UserManager : MonoBehaviour
{
    // URL 설정
    private string baseURL = "http://localhost/public/";

    // Input Fields
    public InputField nameInputField;
    public InputField emailInputField;
    public InputField passwordInputField;

    // 결과 텍스트 출력
    public Text resultText;

    // 사용자 추가 메소드
    public void OnAddUserButtonClick()
    {
        // 입력값 가져오기
        string name = nameInputField.text;
        string email = emailInputField.text;
        string password = passwordInputField.text;

        // 사용자 추가 코루틴 실행
        StartCoroutine(AddUser(name, email, password));
    }

    // 사용자 추가 코루틴
    private IEnumerator AddUser(string name, string email, string password)
    {
        string url = baseURL + "add_user.php";

        WWWForm form = new WWWForm();
        form.AddField("name", name);
        form.AddField("email", email);
        form.AddField("password", password);

        using (UnityWebRequest request = UnityWebRequest.Post(url, form))
        {
            yield return request.SendWebRequest();

            if (request.result == UnityWebRequest.Result.ConnectionError || request.result == UnityWebRequest.Result.ProtocolError)
            {
                Debug.LogError("Error: " + request.error);
                resultText.text = "Error: " + request.error; // 결과 텍스트에 오류 메시지 출력
            }
            else
            {
                string json = request.downloadHandler.text;
                Debug.Log("Response: " + json);
                resultText.text = "Response: " + json; // 결과 텍스트에 서버 응답 출력

                // JSON 파싱
                Response response = JsonUtility.FromJson<Response>(json);

                if (response.success)
                {
                    Debug.Log("User added successfully.");
                    resultText.text = "User added successfully.";
                }
                else
                {
                    Debug.LogError("Failed to add user: " + response.message);
                    resultText.text = "Failed to add user: " + response.message;
                }
            }
        }
    }

    // JSON 응답 파싱용 클래스
    [System.Serializable]
    public class Response
    {
        public bool success;
        public string message;
    }
}

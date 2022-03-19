<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>report</title>
</head>
<style>
    td {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        border: gray 1px solid;
        width: 400px;
        height: 35px;
    }

    table {
        border: gray 1px solid;
    }
</style>

<body>
<div style="border: 2px solid black; width: 70%; margin: 0 auto;">
    <div style="text-align: center;font-family: arial, sans-serif">
        <img src="{{ public_path('dashboard\assets\img\logo2.png') }}" alt="">
        <h1> تسجيل للفصل الثاني 1443 - فردي </h1>
    </div>

    <div>

        {{-- Detaiels--}}
        <table dir="rtl" style="width: 100%; font-weight: bold; border-collapse: collapse;">
            <tbody>
            <tr style="height: 40px;">
                <td style="width: 30%;padding-right:10px;text-align: right;border: 1px solid gray; font-size: 16px;font-family: arial, sans-serif">
                    الاسم:
                </td>
                <td style="border: 1px solid gray;width: 30%; font-size: 16px; text-align: center;font-family: arial, sans-serif">
                    الرقم التسلسلي:
                </td>
                <td style="border: 1px solid gray;width: 40%; font-size: 16px; text-align: center;font-family: arial, sans-serif">
                    القسم:
                </td>
            </tr>
            <tr style="height: 40px">
                <td style="width: 30%;padding-right:10px;text-align: right;border: 1px solid gray; font-size: 16px;font-family: arial, sans-serif">
                    {{ $details->student->name }}
                </td>
                <td style="border: 1px solid gray;width: 30%; font-size: 16px; text-align: center;font-family: arial, sans-serif">
                    {{ $details->student->serial_number }}
                </td>
                <td style="border: 1px solid gray;width: 40%; font-size: 16px; text-align: center;font-family: arial, sans-serif">
                    {{ $details->student->section == '1' ? 'بنين' : 'بنات' }}
                </td>

            </tr>
            <tr style="height: 40px">
                <td style="width: 30%;padding-right:10px;text-align: right;border: 1px solid gray; font-size: 16px;font-family: arial, sans-serif">
                    طريقة الدفع
                </td>
                <td style="border: 1px solid gray;width: 30%; font-size: 16px; text-align: center;font-family: arial, sans-serif">
                    حوالة بنكية
                </td>
                <td style="border: 1px solid gray;width: 80px; font-size: 16px; text-align: center;font-family: arial, sans-serif">
                    <a href="{{url(Storage::url($details->money_transfer_image_path)) }}">صورة الحوالة</a>
                </td>
            </tr>

            </tbody>
        </table>

    </div>
</div>
</body>

</html>

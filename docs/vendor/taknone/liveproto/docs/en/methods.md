# Methods

?> Note, In this section, we only introduced the methods that are for your convenience to work with raw api, and I call them custom methods

---

## update_password()

Updates the account password with a new one or remove it

Usable by :
- [x] Users
- [ ] Bots

> [!NOTE]
> If the value of the parameter `$new` be null , `2FA` will be removed

##### <pre>Arguments</pre>
- password(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Current password ( if required )

- new(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - New password to be set

- hint(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Password hint for recovery

- email(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Recovery email for password reset

##### <pre>Returns</pre>
An instance of [Bool](https://core.telegram.org/type/Bool)

##### <pre>Example</pre>
```php
$client->update_password(password : 'oldPass',new : 'newPass',hint : 'MyHint',email : 'user@example.com');
```

---

## send_email_code()

Sends a verification code to the provided email

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- email(<small>string</small>) <kbd style="color : red">required</kbd> :
  - The email address to send the verification code

- email_purpose(<small>EmailPurpose</small>) <kbd onclick = "alert('default : EmailPurpose::LOGINSETUP')">optional</kbd> :
  - The purpose of the email verification request

##### <pre>Returns</pre>
An instance of [SentEmailCode](https://core.telegram.org/type/account.SentEmailCode)

##### <pre>Example</pre>
```php
$client->send_email_code(email : 'user@example.com');
```

---

## verify_email()

Verifies an email with the provided code

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- code(<small>string</small>,<small>int</small>) <kbd style="color : red">required</kbd> :
  - The verification code sent to the email

- email_purpose(<small>EmailPurpose</small>) <kbd onclick = "alert('default : EmailPurpose::LOGINSETUP')">optional</kbd> :
  - The purpose for which the email verification is being performed

##### <pre>Returns</pre>
An instance of [Bool](https://core.telegram.org/type/Bool)

##### <pre>Example</pre>
```php
$client->verify_email(code : 123456);
```

---

## send_code()

Send the confirmation code to the given phone number

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- phone_number(<small>string</small>) <kbd style="color : red">required</kbd> :
  - The phone to which the code will be sent

- ...settings(<small>mixed</small>) <kbd onclick = "alert('default : empty')">optional</kbd> :
  - Any additional parameters you give will be passed to the [codeSettings](https://core.telegram.org/constructor/codeSettings) construct

##### <pre>Returns</pre>
An instance of [SentCode](https://core.telegram.org/constructor/auth.sentCode)

##### <pre>Example</pre>
```php
$client->send_code(phone_number : '+1234567890');

$client->send_code(phone_number : '+8884567890', unknown_number : true);
```

---

## sign_in()

Logs in to Telegram to an existing user or bot

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- code(<small>string</small>,<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - The code that Telegram sent. If you sent it through the application, it will expire immediately.

- password(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - 2FA password, required if `SESSION_PASSWORD_NEEDED` exception is raised.

- token(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Used to sign in as a bot

- email(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Set email verification

##### <pre>Returns</pre>
An instance of [Authorization](https://core.telegram.org/constructor/authorization)

##### <pre>Example</pre>
```php
$client->sign_in(code : 12345);

$client->sign_in(code : 12345,email : 'tak@liveproto.dev');

$client->sign_in(password : 'HelloWorld');

$client->sign_in(token : '4839574812:AAFD39kkdpWt3ywyRZergyOLMaJhac60qc');
```

---

## sign_up()

This method is used to create a new account and your client must be [official](configuration.md#Params)

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- first_name(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Set a first name for your account

- last_name(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Set a last name for your account

##### <pre>Returns</pre>
An instance of [Authorization](https://core.telegram.org/constructor/authorization)

##### <pre>Example</pre>
```php
$client->sign_up(first_name : 'Tak', last_name : 'None');
```

---

## resend_code()

Resends the confirmation code

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Returns</pre>
An instance of [SentCode](https://core.telegram.org/constructor/auth.sentCode)

##### <pre>Example</pre>
```php
$client->resend_code();
```

---

## cancel_code()

Cancels the confirmation code

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Returns</pre>
An instance of [Bool](https://core.telegram.org/type/Bool)

##### <pre>Example</pre>
```php
$client->cancel_code();
```

---

## firebase_sms()

This method is used to send a code via SMS, and your client must be [official](configuration.md#Params)

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- safety(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Safety net token

- push(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - iOS push secret

##### <pre>Returns</pre>
An instance of [Bool](https://core.telegram.org/type/Bool)

##### <pre>Example</pre>
```php
$client->firebase_sms();
```

---

## log_out()

Logs out from the current session

Usable by :
- [x] Users
- [x] Bots

##### <pre>Returns</pre>
An instance of [LoggedOut](https://core.telegram.org/constructor/auth.loggedOut)

##### <pre>Example</pre>
```php
$client->log_out();
```

---

## login_token()

Generates a login token

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- except_ids(<small>array&amp;lt;int&amp;gt;</small>) <kbd onclick = "alert('default : array()')">optional</kbd> :
  - List of already logged-in user IDs, to prevent logging in twice with the same user

##### <pre>Returns</pre>
String like `tg://login?token=base64encodedtoken`

##### <pre>Example</pre>
```php
$client->login_token();
```

---

## accept_token()

Accepts a login token embedded in a QR code

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- token(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Login token embedded in QR code

##### <pre>Returns</pre>
An instance of [Authorization](https://core.telegram.org/constructor/authorization)

##### <pre>Example</pre>
```php
$client->accept_token(token : 'tg://login?token=base64encodedtoken');
```

---

## wait_token()

Waits for a login token to be accepted

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- except_ids(<small>array&amp;lt;int&amp;gt;</small>) <kbd onclick = "alert('default : array()')">optional</kbd> :
  - List of already logged-in user IDs, to prevent logging in twice with the same user

- timeout(<small>int</small>) <kbd onclick = "alert('default : 30')">optional</kbd> :
  - Set a time out for waiting

##### <pre>Returns</pre>
An instance of [Authorization](https://core.telegram.org/constructor/authorization)

##### <pre>Example</pre>
```php
$client->wait_token(timeout : 60);
```

---

## click_button()

Clicks on an inline button within a message

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- message(<small>object</small>) <kbd style="color : red">required</kbd> :
  - The message object containing the button

- i(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Row index of the button

- j(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Column index of the button

- text(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - The text of the button to click

- data(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback data of the button

- query(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Query of the button

- filter(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - A function to filter buttons

- password(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - This is for those buttons that require 2FA

- contact(<small>array</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  -  To share contact

- geo(<small>array</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - To share location

- user(<small>string</small>,<small>int</small>,<small>null</small>,<small>object</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Clicking on the button switch inline must have a destination to send to , as well as the button request peer

##### <pre>Returns</pre>
A mixed response depending on the button type

##### <pre>Example</pre>
```php
$client->click_button(message : $message,i : 0,j : 1);

$client->click_button(message : $message,text : 'Hello');

$client->click_button(message : $message,filter : function(object $button) : bool {
	if(isset($button->text) and str_starts_with($button->text,'X...')){
		/* ✅ Yes, I want to click this button */
		return true;
	} else {
		/* ❌ No, this is not the button I want */
		return false;
	}
});
```

---

## get_dialogs()

Retrieves a list of dialogs ( chats , groups , channels , etc... )

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- limit(<small>int</small>) <kbd onclick = "alert('default : PHP_INT_MAX')">optional</kbd> :
  - The maximum number of dialogs to retrieve

- id(<small>int</small>) <kbd onclick = "alert('default : 0')">optional</kbd> :
  - Offset ID for pagination

- date(<small>int</small>) <kbd onclick = "alert('default : 0')">optional</kbd> :
  - Offset date for pagination

- peer(<small>string</small>,<small>int</small>,<small>null</small>,<small>object</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Offset peer

- hash(<small>int</small>) <kbd onclick = "alert('default : 0')">optional</kbd> :
  - Hash value for optimization purposes

- pinned(<small>true</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Exclude pinned chats if set to true

- folder(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Folder ID to filter dialogs by specific folders

- callback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback function to process each batch of dialogs

##### <pre>Returns</pre>
An array of retrieved dialogs

##### <pre>Example</pre>
```php
$client->get_dialogs(limit : 50,peer : '@LiveProto',callback : function(object $result) : bool {
	/*
	You can see the results of each step
	*/
	return true; // If it is false , the process stops
});
```

---

## get_difference()

Fetches update differences ( messages , edits , etc... )

Usable by :
- [x] Users
- [x] Bots

> [!NOTE]
> This method returns a generator , use foreach to iterate

##### <pre>Arguments</pre>
- pts(<small>int</small>) <kbd onclick = "alert('default : 1')">optional</kbd> :
  - The last known PTS (Persistent Timestamp)

- date(<small>int</small>) <kbd onclick = "alert('default : 1')">optional</kbd> :
  - The last known update date

- qts(<small>int</small>) <kbd onclick = "alert('default : 1')">optional</kbd> :
  - The last known QTS (Queue Timestamp)

- total_limit(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : 0x7fffffff')">optional</kbd> :
  - Simply tells the server to not return the difference if it is bigger than `pts_total_limit`, If the remote pts is too big

- pts_limit(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Simply tells the server to not return the difference if it is bigger than `pts_total_limit`, If the remote pts is too big

- qts_limit(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Simply tells the server to not return the difference if it is bigger than `pts_total_limit`, If the remote pts is too big

- deep(<small>bool</small>) <kbd onclick = "alert('default : false')">optional</kbd> :
  - Whether to perform a deep fetch when differences are too long

##### <pre>Returns</pre>
An array containing the difference updates

##### <pre>Example</pre>
```php
foreach($client->get_difference() as $difference){
	var_dump($difference);
}
```

---

## get_channel_difference()

Retrieves incremental updates ( messages , edits , and other events ) for a specific channel

Usable by :
- [x] Users
- [x] Bots

> [!NOTE]
> This method returns a generator , use foreach to iterate

##### <pre>Arguments</pre>
- channel(<small>int</small>,<small>string</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Identifier of the channel can be a channel ID , username string , or Channel object

- filter(<small>object</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - The filter must be of type `ChannelMessagesFilter`

- pts(<small>int</small>) <kbd onclick = "alert('default : 1')">optional</kbd> :
  - Current pts state for this channel , use the last received pts to continue from where you left off

- limit(<small>int</small>) <kbd onclick = "alert('default : 0x7fffffff')">optional</kbd> :
  - Maximum number of updates to fetch per request ( Telegram may enforce its own limits )

##### <pre>Returns</pre>
A generator yielding `Updates` objects ( containing messages , other updates , users , chats ) until no new updates are available

##### <pre>Example</pre>
```php
foreach($client->get_channel_difference('@LiveProto') as $channelDifference){
	var_dump($channelDifference);
}
```

---

## download_file()

Downloads a file from Telegram servers using file location and optional decryption

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- size(<small>int</small>) <kbd style="color : red">required</kbd> :
  - Size of the file

- dcid(<small>int</small>) <kbd style="color : red">required</kbd> :
  - Data center ID

- location(<small>object</small>) <kbd style="color : red">required</kbd> :
  - File location object

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback for download progress

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Encryption key if file is encrypted

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Initialization vector for decryption

##### <pre>Returns</pre>
Returns the path of the downloaded file

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@LiveProto');
$photo_id = $client->get_peer($peer)->photo->photo_id;
$location = $client->inputPeerPhotoFileLocation(peer : $peer,photo_id : $photo_id,big : true);


$client->download_file(path : __DIR__.DIRECTORY_SEPARATOR.'file.png',size : 2 * 1024 * 1024,dcid : 3,location : $location);
```

---

## download_photo()

Downloads a photo media object

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - Photo or message media photo object

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback for download progress

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Encryption key (optional)

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Initialization vector (optional)

##### <pre>Returns</pre>
Returns the path to the downloaded photo

##### <pre>Example</pre>
```php
$full = $client->get_full_peer('@LiveProto');

$client->download_photo(path : './file.jpg',file : $full->chat_photo);
```

---

## download_profile_photo()

Downloads a profile photo from user , chat , or channel

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - User,Chat,or Channel object containing a profile photo

- big(<small>bool</small>) <kbd onclick = "alert('default : true')">optional</kbd> :
  - Whether to download the big size

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback for download progress

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Decryption key (if required)

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Initialization vector for decryption

##### <pre>Returns</pre>
Returns the path to the downloaded profile photo

##### <pre>Example</pre>
```php
$peer = $client->get_peer('@LiveProto');

$client->download_profile_photo(path : './file.jpeg',file : $peer);
```

---

## download_document()

Downloads a document or its thumbnail

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - Document or message media document object

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback for download progress

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Decryption key (if required)

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Initialization vector for decryption

- thumb(<small>bool</small>) <kbd onclick = "alert('default : false')">optional</kbd> :
  - Whether to download the document thumbnail instead of full document

##### <pre>Returns</pre>
Returns the path of the downloaded document

##### <pre>Example</pre>
```php
$stickerSet = $client->inputStickerSetShortName(short_name : 'LiveProto'); // like : https://t.me/addemoji/LiveProto
$stickers = $client->messages->getStickerSet(stickerset : $stickerSet,hash : 0);
$document = $stickers->documents[0]; // the first emoji / sticker

$client->download_document(path : './file.tgs',file : $document);
```

---

## download_web_document()

Downloads a web document from its URL

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - WebDocument object containing URL and metadata

##### <pre>Returns</pre>
Returns the path to the downloaded web document

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('me');
$status = $client->payments->getStarsStatus(peer : $peer);
if($status->subscriptions){
	$subscription = $status->subscriptions[0];
	if($subscription->photo){
		$client->download_web_document(path : './file.unknown',file : $subscription->photo);
	}
}
```

---

## download_contact()

Downloads contact information as a vCard

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - Media contact object containing vCard

##### <pre>Returns</pre>
Returns the path of the saved vCard file

##### <pre>Example</pre>
```php
$mediaContact = $client->inputMediaContact(phone_number : '+123456789',first_name : 'Live',last_name : 'Proto',vcard : '');

$client->download_contact(path : './file.vcard',file : $mediaContact);
```

---

## download_secret_file()

Downloads and decrypts a secret / encrypted file

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - Encrypted file object or decrypted message object

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback for download progress

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Encryption key for decryption

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Encryption iv for decryption

##### <pre>Returns</pre>
Returns the path to the downloaded and decrypted file

##### <pre>Example</pre>
```php
$encryptedMessage = $client->fetchUpdate(array('updateNewEncryptedMessage','updateEncryption'),callback : fn(object $update) : bool => $update->message->file instanceof \Tak\Liveproto\Tl\Types\Other\EncryptedFile,timeout : 100)->await();

$path = $client->download_secret_file(path : './file',file : $encryptedMessage);

/* If you have not chosen any extension for your file, we will choose one for you and include it in the output */
echo 'Path : ' , $path , PHP_EOL;
```

---

## download_media()

Automatically downloads the correct media type ( photo , document , ... )

Usable by :
- [x] Users
- [x] Bots

> [!NOTE]
> I suggest you only use other download methods when necessary. The easiest and best way is to use this method

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Destination file path

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - Media object ( photo , document , contact , ... )

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Callback for download progress

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Decryption key ( if required )

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Decryption iv ( if required )

##### <pre>Returns</pre>
Returns the path to the downloaded media file

##### <pre>Example</pre>
```php
$stickerSet = $client->inputStickerSetDice(emoticon : '🎯');
$stickers = $client->messages->getStickerSet(stickerset : $stickerSet,hash : 0);
$document = $stickers->documents[array_rand($stickers->documents)];

$client->download_media(path : './file.tgs',file : $document,progresscallback : function(float $percentage) : mixed {
	echo $percentage , '%' , PHP_EOL;
	return true; // If you return false, the download will stop
});
```

---

## markdown()

Parses a Markdown‑formatted string into a Telegram text + entities array

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- text(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Your Markdown‑formatted text

##### <pre>Returns</pre>
An array with `text` and `entities` parsed from Markdown

##### <pre>Example</pre>
```php
list($text,$entities) = $client->markdown('
Thank you for using the [LiveProto 🌱](https://t.me/LiveProto) library

\```php
print \'I ❤️ LiveProto\';
\```

~~Strike~~

__Underline__

"Blockquote"

**Bold**

_Italic_

`Code`

||Spoiler||
');

$peer = $client->get_input_peer('@TakNone');
$client->messages->sendMessage(peer : $peer,message : $text,random_id : random_int(PHP_INT_MIN,PHP_INT_MAX),entities : $entities);
```

---

## markdown_escape()

Escape string for Markdown‑formatted

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- text(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Your Markdown‑formatted text

##### <pre>Returns</pre>
An escaped string

##### <pre>Example</pre>
```php
$escaped = $client->markdown_escape('~~Strike~~');

list($text,$entities) = $client->markdown('How do we create a string like ~~Strike~~ ? Well, like '.$escaped);

$peer = $client->get_input_peer('@TakNone');
$client->messages->sendMessage(peer : $peer,message : $text,random_id : random_int(PHP_INT_MIN,PHP_INT_MAX),entities : $entities);
```

---

## html()

Parses an HTML‑formatted string into a Telegram text + entities array

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- text(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Your HTML‑formatted text

##### <pre>Returns</pre>
An array with `text` and `entities` parsed from HTML

##### <pre>Example</pre>
```php
list($text,$entities) = $client->html('
Thank you for using the <a href = "https://t.me/LiveProto">LiveProto 🌱</a> library

<b>bold</b>, <strong>bold</strong>

<i>italic</i>, <em>italic</em>

<u>underline</u>, <ins>underline</ins>

<s>strikethrough</s>, <strike>strikethrough</strike>, <del>strikethrough</del>

<span class = "tg-spoiler">spoiler</span>, <tg-spoiler>spoiler</tg-spoiler>

<b>bold <i>italic bold <s>italic bold strikethrough <span class = "tg-spoiler">italic bold strikethrough spoiler</span></s> <u>underline italic bold</u></i> bold</b>

<a href = "http://www.example.com/">inline URL</a>

<a href = "tg://user?id=123456789">inline mention of a user</a>

<tg-emoji emoji-id = "5820916017458583465">🌱</tg-emoji>

<code>inline fixed-width code</code>

<pre>pre-formatted fixed-width code block</pre>

<pre><code class = "language-python">pre-formatted fixed-width code block written in the Python programming language</code></pre>

<blockquote>
Block quotation started
Block quotation continued
The last line of the block quotation
</blockquote>

<blockquote expandable>
Expandable block quotation started
Expandable block quotation continued
Expandable block quotation continued
Hidden by default part of the block quotation started
Expandable block quotation continued
The last line of the block quotation
</blockquote>
');

$peer = $client->get_input_peer('@TakNone');
$client->messages->sendMessage(peer : $peer,message : $text,random_id : random_int(PHP_INT_MIN,PHP_INT_MAX),entities : $entities);
```

---

## html_escape()

Escape string for HTML‑formatted

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- text(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Your HTML‑formatted text

##### <pre>Returns</pre>
An escaped string

##### <pre>Example</pre>
```php
$escaped = $client->html_escape('<s>strikethrough</s>');

list($text,$entities) = $client->html('How do we create a string like <s>strikethrough</s> ? Well, like '.$escaped);

$peer = $client->get_input_peer('@TakNone');
$client->messages->sendMessage(peer : $peer,message : $text,random_id : random_int(PHP_INT_MIN,PHP_INT_MAX),entities : $entities);
```

---

## format_entities()

Formats a plain string using a given set of message entities

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- text(<small>string</small>) <kbd style="color : red">required</kbd> :
  - The plain text to format

- entities(<small>array</small>) <kbd style="color : red">required</kbd> :
  - An array of `MessageEntity` objects / descriptors

##### <pre>Returns</pre>
An array with the formatted `text` and adjusted `entities`

##### <pre>Example</pre>
```php
list($text,$entities) = $client->html('Thank you for using the <a href = "https://t.me/s/LiveProto">LiveProto 🌱</a> library');

$formatted = $client->format_entities(text : $text,entities : $entities);

foreach($formatted as $newEntity){
	echo 'Text : ' , $newEntity->text , PHP_EOL;
	if(isset($newEntity->url)){
		var_dump($newEntity->open());
	}
}
```

---

## fromBotAPI()

Parses a Telegram Bot API-style file_id and converts it into an internal file representation

Usable by :
- [x] Users
- [x] Bots

> [!NOTE]
> In the result, the closure `download` , it takes parameters ( `$path` , `$progresscallback` , `$key` , `$iv` ) that are passed to the [download_file](en/functions.md#download_file) method

##### <pre>Arguments</pre>
- file_id(<small>string</small>) <kbd style="color : red">required</kbd> :
  - The file_id string received from the Bot API (e.g., in a message)

##### <pre>Returns</pre>
An object representing the decoded internal file reference (e.g., location, ID, type)

##### <pre>Example</pre>
```php
$fileObject = $client->fromBotAPI('AgACAgUAAxkBAA..');

echo 'File type : ' , $fileObject->file_type , PHP_EOL;
echo 'File data center id : ' , $fileObject->dc_id , PHP_EOL;

$realpath = $fileObject->download(path : './file');

echo 'File downloaded in : ' , $realpath;
```

---

## toBotAPI()

Encodes an internal MTProto file reference into a Telegram Bot API‐style `file_id` string

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- file_type(<small>FileIdType</small>) <kbd style="color : red">required</kbd> :
  - The enumerated file ID type ( e.g. Photo , Document ) as [`FileIdType`](en/enums.md#FileIdType)

- dc_id(<small>int</small>) <kbd style="color : red">required</kbd> :
  - Data center ID where the file is stored

- input_location(<small>object</small>) <kbd style="color : red">required</kbd> :
  - Internal location object ( e.g. `InputDocumentFileLocation` , `inputWebDocument` , ... ) containing identifiers like `volume_id` , `local_id` , `secret` , `url` parameters

- version(<small>int</small>) <kbd onclick = "alert('default : 4')">optional</kbd> :
  - MTProto file_id version , must match the protocol version expected by Bot API

- sub_version(<small>int</small>) <kbd onclick = "alert('default : 54')">optional</kbd> :
  - MTProto file_id sub-version or class identifier , used internally by Telegram

##### <pre>Returns</pre>
A base64 URL-safe string representing the Bot API `file_id`

##### <pre>Example</pre>
```php
$file_id = 'AgACAgUAAxkBAA..';

$fileObject = $client->fromBotAPI($file_id);

$generated = $client->toBotAPI($fileObject->file_type,$fileObject->dc_id,$fileObject->input_location,$fileObject->version,$fileObject->sub_version);

var_dump($file_id === $generated);
```

---

## inline_query()

Executes an inline bot query and returns results

Usable by :
- [x] Users
- [ ] Bots

> [!NOTE]
> In the result , the closure `click` , it also takes additional parameters (mixed ...$args) that are passed to the [click_inline](en/functions.md#click_inline) method

##### <pre>Arguments</pre>
- bot(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Username , ID , or bot entity to query

- query(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - The inline query string

- offset(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Offset for paginated results

- peer(<small>string</small>,<small>int</small>,<small>object</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Peer (chat) where results will be sent

- geo_point(<small>object</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Optional geo-location for the query

##### <pre>Returns</pre>
An instance of [BotResults](https://core.telegram.org/type/messages.BotResults) containing inline query results,with a `click` helper

##### <pre>Example</pre>
```php
$results = $client->inline_query(bot : '@like',query : 'Do you enjoy working with LiveProto ?');

$resultSent = $results->click(index : 0); // Clicks the first result

$resultSent =  $results->click(type : 'article'); // Click on the first result with the type article

$resultSent = $results->click(type : 'article',index : 1); // Click on the second result with the type article

$resultSent->click(text : '👍'); // Clicking on the buttons of the result that has been sent
```

---

## get_prepared_inline_message()

Retrieves a prepared inline message result for a bot and lets you send it into a chat via its `click` helper

Usable by :
- [x] Users
- [ ] Bots

> [!NOTE]
> In the result , the closure `click` , it also takes additional parameters (mixed ...$args) that are passed to the [click_inline](en/functions.md#click_inline) method

##### <pre>Arguments</pre>
- bot(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Bot username , ID or bot entity whose inline results you want

- id(<small>string</small>) <kbd style="color : red">required</kbd> :
  - The ID of the inline result has been prepared [PreparedInlineMessage](https://core.telegram.org/bots/api#preparedinlinemessage)

##### <pre>Returns</pre>
An instance of [PreparedInlineMessage](https://core.telegram.org/constructor/messages.PreparedInlineMessage) with a `click` closure

##### <pre>Example</pre>
```php
$result = $client->get_prepared_inline_message(bot : '@like',id : 'some-result‑id');

$result->click(peer : '@LiveProtoChat');
```

---

## click_inline()

Clicks ( sends ) a chosen inline result into a chat

Usable by :
- [x] Users
- [ ] Bots

> [!NOTE]
> It is better not to use this function directly because its closure is intended for the output of methods related to inline queries. In the result, the closure `click` , it also takes additional parameters (mixed ...$args) that are passed to the [click_button](en/functions.md#click_button) method

##### <pre>Arguments</pre>
- query_id(<small>int</small>) <kbd style="color : red">required</kbd> :
  - ID of the inline query session

- id(<small>string</small>) <kbd style="color : red">required</kbd> :
  - ID of the result to send

- peer(<small>string</small>,<small>int</small>,<small>object</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Target peer ( chat ) where the result will be sent

- ...args(<small>mixed</small>) <kbd onclick = "alert('default : empty')">optional</kbd> :
  - Any additional parameters you give will be passed to the [sendInlineBotResult](https://core.telegram.org/method/messages.sendInlineBotResult)

##### <pre>Returns</pre>
A Update , potentially with a `click` closure for click on buttons

##### <pre>Example</pre>
```php
$result = $client->click_inline(query_id : 123456789,id : 'result-id',peer : '@LiveProtoChat');

$result->click(text : '👍'); // Clicking on the buttons of the result that has been sent
```

---

## get_input_peer()

Returns the input peer object ( InputPeerUser , InputPeerChat , etc. ) for the given peer identifier

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>null</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Username, user ID, or object representing the peer

- hash(<small>int</small>) <kbd onclick = "alert('default : 0')">optional</kbd> :
  - Hash value used to fetch specific peer state ( usually not needed )

##### <pre>Returns</pre>
An instance of [InputPeer](https://core.telegram.org/type/InputPeer)

##### <pre>Example</pre>
```php
$inputPeer = $client->get_input_peer(null); // inputPeerEmpty //

$inputPeer = $client->get_input_peer('me'); // inputPeerSelf //
$inputPeer = $client->get_input_peer('bot'); // inputPeerSelf //

$inputPeer = $client->get_input_peer('@username'); // inputPeerChannel //
$inputPeer = $client->get_input_peer('+42777'); // inputPeerUser //

$inputPeer = $client->get_input_peer(777000); // inputPeerUser //
```

---

## get_peer()

Returns the full resolved peer information (user, chat, or channel) for the given peer input

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Username,user ID,or peer object

##### <pre>Returns</pre>
An instance of [User](https://core.telegram.org/constructor/user), [Chat](https://core.telegram.org/constructor/chat), or [Channel](https://core.telegram.org/constructor/channel)

##### <pre>Example</pre>
```php
$inputPeer = $client->get_peer('@example_user');
```

---

## get_full_peer()

Retrieves the complete peer info including full profile details and settings

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Peer to fetch full info for ( username, ID, or object )

##### <pre>Returns</pre>
An instance of [UserFull](https://core.telegram.org/constructor/userFull) or [ChatFull](https://core.telegram.org/constructor/chatFull) or [ChannelFull](https://core.telegram.org/constructor/channelFull)

##### <pre>Example</pre>
```php
var_dump($client->get_full_peer('@LiveProto'));
```

---

## get_peer_id()

Extracts the unique identifier ( ID ) from a peer input

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Peer input (ID,username,or object)

##### <pre>Returns</pre>
An integer representing the Telegram user/chat/channel ID

##### <pre>Example</pre>
```php
var_dump($client->get_peer_id('@LiveProto'));
```

---

## get_peer_type()

Returns the peer type ( user or chat or channel) based on the input

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Target peer to analyze

##### <pre>Returns</pre>
An instance of enum [`PeerType`](en/enums.md#PeerType)

##### <pre>Example</pre>
```php
var_dump($client->get_peer_type('@LiveProto')); // enum(Tak\Liveproto\Enums\PeerType::CHANNEL)
```

---

## send_secret_message()

Sends a text message in an end‐to‐end encrypted secret chat with a self‐destruct timer

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - The recipient of the secret message ( user ID, username, or user object )

- message(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Text content to send in the secret chat

- ttl(<small>int</small>) <kbd style="color : red">required</kbd> :
  - Time‐to‐live (self‑destruct) for the message, in seconds

- ...arguments(<small>mixed</small>) <kbd onclick = "alert('default : empty')">optional</kbd> :
  - Any additional parameters you give will be passed to the [decryptedMessage](https://core.telegram.org/constructor/decryptedMessage)

##### <pre>Returns</pre>
An instance of [SentEncryptedMessage](https://core.telegram.org/type/messages.SentEncryptedMessage)

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$client->send_secret_message(peer : $peer,message : 'This will vanish soon!',ttl : 10);
```

---

## send_secret_file()

Sends a file with a caption in a secret chat , encrypted end‑to‑end

Usable by :
- [x] Users
- [ ] Bots

> [!NOTE]
> Please use method [send_secret_media](en/functions.md#send_secret_media) instead

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - The recipient of the file ( user ID, username, or user object )

- file(<small>object</small>) <kbd style="color : red">required</kbd> :
  - The file object to send (e.g., InputEncryptedFile)

- message(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Caption or description for the file

- ttl(<small>int</small>) <kbd style="color : red">required</kbd> :
  - Time in seconds before the message self‑destructs after viewing

- ...arguments(<small>mixed</small>) <kbd onclick = "alert('default : empty')">optional</kbd> :
  - Any additional parameters you give will be passed to the [decryptedMessage](https://core.telegram.org/constructor/decryptedMessage)

##### <pre>Returns</pre>
An instance of [SentEncryptedMessage](https://core.telegram.org/type/messages.SentEncryptedMessage)

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$path = './file.unknown';

list($file,$key,$iv) = $client->upload_secret_file(path : $path);

$attributes = array($client->secret->documentAttributeFilename(file_name : $path));

$media = $client->secret->decryptedMessageMediaDocument(thumb : strval(null),thumb_w : 0,thumb_h : 0,mime_type : mime_content_type($path),size : filesize($path),key : $key,iv : $iv,attributes : $attributes,caption : 'The caption');

$client->send_secret_file(peer : $peer,file : $file,message : 'The caption',ttl : 10,media : $media);
```

---

## send_secret_media()

Sends a photo, video, audio or document in a secret chat with encryption and self‐destruct

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - The recipient ( user ID, username, or object )

- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Local filesystem path to the media file

- caption(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Caption text for the media

- ttl(<small>int</small>) <kbd style="color : red">required</kbd> :
  - Self‑destruct timer in seconds

##### <pre>Returns</pre>
An instance of [SentEncryptedMessage](https://core.telegram.org/type/messages.SentEncryptedMessage)

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$client->send_secret_media(peer : $peer,path : './file.unknown',caption : 'The caption',ttl : 10);
```

---

## start_secret_chat()

Initiates a new secret chat session ( Diffie‑Hellman handshake )

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - User to start a secret chat with ( ID, username, or object )

##### <pre>Returns</pre>
An instance of [EncryptedChat](https://core.telegram.org/type/EncryptedChat)

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$client->start_secret_chat(peer : $peer);
```

---

## close_secret_chat()

Closes an active secret chat, destroying keys

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Peer whose secret chat should be closed

- ...arguments(<small>mixed</small>) <kbd onclick = "alert('default : empty')">optional</kbd> :
  - Any additional parameters you give will be passed to the [discardEncryption](https://core.telegram.org/method/messages.discardEncryption)

##### <pre>Returns</pre>
An instance of [Bool](https://core.telegram.org/type/Bool)

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$client->close_secret_chat(peer : $peer);
```

---

## getTTL()

Gets the current default TTL for messages in the secret chat

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Peer whose TTL you want to retrieve

##### <pre>Returns</pre>
Integer TTL value (seconds)

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$ttl = $client->getTTL(peer : $peer);
```

---

## get_secret_chat()

Retrieves the secret chat object for a given peer

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Peer whose secret chat you want to get

##### <pre>Returns</pre>
Array representing the secret chat state

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$chat = $client->get_secret_chat(peer : $peer);

var_dump($chat);
```

---

## remove_secret_chat()

Removes secret chat data for a specific peer

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- peer(<small>string</small>,<small>int</small>,<small>object</small>) <kbd style="color : red">required</kbd> :
  - Peer whose secrets should be removed

##### <pre>Returns</pre>
void

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$client->remove_secret(peer : $peer);
```

---

## upload_file()

Uploads a file to Telegram servers

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Path to the file on the local disk

- progresscallback(<small>callable</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Optional function to receive progress updates (percentage)

- key(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Optional AES encryption key if the file should be encrypted

- iv(<small>string</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Optional initialization vector (IV) for encryption

##### <pre>Returns</pre>
An instance of [inputFile](https://core.telegram.org/type/InputFile) or [InputEncryptedFile](https://core.telegram.org/type/InputEncryptedFile)

##### <pre>Example</pre>
```php
$start = microtime(true);

$client->upload_file(path : './file.mp4',progresscallback : function(float $percent) use($start) : bool {
	$finish = microtime(true);

	echo 'Process progress percentage : ' , intval($percent) , '%' , PHP_EOL;

	/* If the output is false the process will stop , so I wrote a timeout example here for 2 minutes */
	return boolval($finish - $start < 2 * 60);
});
```

---

## upload_secret_file()

Encrypts and uploads a file for secret chats, returning metadata and encryption info

Usable by :
- [x] Users
- [ ] Bots

##### <pre>Arguments</pre>
- path(<small>string</small>) <kbd style="color : red">required</kbd> :
  - Path to the file on local disk to be encrypted and uploaded

- ...arguments(<small>mixed</small>) <kbd onclick = "alert('default : empty')">optional</kbd> :
  - Any additional parameters you give will be passed to the [upload_file](en/functions.md#upload_file)

##### <pre>Returns</pre>
An array containing An instance of [InputEncryptedFile](https://core.telegram.org/type/InputEncryptedFile) and encryption details

##### <pre>Example</pre>
```php
$peer = $client->get_input_peer('@TakNone');

$path = './file.unknown';

list($file,$key,$iv) = $client->upload_secret_file(path : $path);

$attributes = array($client->secret->documentAttributeFilename(file_name : $path));

$media = $client->secret->decryptedMessageMediaDocument(thumb : strval(null),thumb_w : 0,thumb_h : 0,mime_type : mime_content_type($path),size : filesize($path),key : $key,iv : $iv,attributes : $attributes,caption : 'The caption');

$client->send_secret_file(peer : $peer,file : $file,message : 'The caption',ttl : 10,media : $media);
```

---

## get_input_user()

Resolves and returns an input user object to be used in API methods

Usable by :
- [x] Users
- [x] Bots

##### <pre>Arguments</pre>
- user(<small>string</small>,<small>int</small>,<small>object</small>,<small>null</small>) <kbd style="color : red">required</kbd> :
  - User identifier (username, ID, or full user object)

- peer(<small>string</small>,<small>int</small>,<small>object</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Optional peer context if resolving user by message

- msg_id(<small>int</small>,<small>null</small>) <kbd onclick = "alert('default : null')">optional</kbd> :
  - Optional message ID when using inline bot messages

##### <pre>Returns</pre>
An instance of [InputUser](https://core.telegram.org/type/InputUser)

##### <pre>Example</pre>
```php
$inputPeer = $client->get_input_peer('me');

$inputUser = $client->get_input_user('@LiveProtoBot');

$client->messages->startBot(bot : $inputUser,peer : $inputPeer,start_param : 'love',random_id : random_int(PHP_INT_MIN,PHP_INT_MAX));
```

---

## get_me()

Returns the current authorized user or bot

Usable by :
- [x] Users
- [x] Bots

##### <pre>Returns</pre>
An instance of [User](https://core.telegram.org/constructor/user)

##### <pre>Example</pre>
```php
var_dump($client->get_me());
```

---

## is_bot()

Checks whether the current client is authorized as a bot

Usable by :
- [x] Users
- [x] Bots

##### <pre>Returns</pre>
Returns true if the client is a bot, false if a user

##### <pre>Example</pre>
```php
var_dump($client->is_bot());
```

---

?> Note, The ones you read were only custom methods created by the library, not methods you can call directly ! [Call Raw Functions](en/invoking.md)

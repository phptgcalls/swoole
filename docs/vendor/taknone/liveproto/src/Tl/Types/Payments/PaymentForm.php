<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long form_id long bot_id string title string description invoice invoice long provider_id string url Vector<User> users true can_save_credentials true password_missing webdocument photo string native_provider datajson native_params Vector<PaymentFormMethod> additional_methods paymentrequestedinfo saved_info Vector<PaymentSavedCredentials> saved_credentials
 * @return payments.PaymentForm
 */

final class PaymentForm extends Instance {
	public function request(int $form_id,int $bot_id,string $title,string $description,object $invoice,int $provider_id,string $url,array $users,? true $can_save_credentials = null,? true $password_missing = null,? object $photo = null,? string $native_provider = null,? object $native_params = null,? array $additional_methods = null,? object $saved_info = null,? array $saved_credentials = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa0058751);
		$flags = 0;
		$flags |= is_null($can_save_credentials) ? 0 : (1 << 2);
		$flags |= is_null($password_missing) ? 0 : (1 << 3);
		$flags |= is_null($photo) ? 0 : (1 << 5);
		$flags |= is_null($native_provider) ? 0 : (1 << 4);
		$flags |= is_null($native_params) ? 0 : (1 << 4);
		$flags |= is_null($additional_methods) ? 0 : (1 << 6);
		$flags |= is_null($saved_info) ? 0 : (1 << 0);
		$flags |= is_null($saved_credentials) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($form_id);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->write($invoice->read());
		$writer->writeLong($provider_id);
		$writer->tgwriteBytes($url);
		if(is_null($native_provider) === false):
			$writer->tgwriteBytes($native_provider);
		endif;
		if(is_null($native_params) === false):
			$writer->write($native_params->read());
		endif;
		if(is_null($additional_methods) === false):
			$writer->tgwriteVector($additional_methods,'PaymentFormMethod');
		endif;
		if(is_null($saved_info) === false):
			$writer->write($saved_info->read());
		endif;
		if(is_null($saved_credentials) === false):
			$writer->tgwriteVector($saved_credentials,'PaymentSavedCredentials');
		endif;
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['can_save_credentials'] = true;
		else:
			$result['can_save_credentials'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['password_missing'] = true;
		else:
			$result['password_missing'] = false;
		endif;
		$result['form_id'] = $reader->readLong();
		$result['bot_id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 5)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		$result['invoice'] = $reader->tgreadObject();
		$result['provider_id'] = $reader->readLong();
		$result['url'] = $reader->tgreadBytes();
		if($flags & (1 << 4)):
			$result['native_provider'] = $reader->tgreadBytes();
		else:
			$result['native_provider'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['native_params'] = $reader->tgreadObject();
		else:
			$result['native_params'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['additional_methods'] = $reader->tgreadVector('PaymentFormMethod');
		else:
			$result['additional_methods'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['saved_info'] = $reader->tgreadObject();
		else:
			$result['saved_info'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['saved_credentials'] = $reader->tgreadVector('PaymentSavedCredentials');
		else:
			$result['saved_credentials'] = null;
		endif;
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>
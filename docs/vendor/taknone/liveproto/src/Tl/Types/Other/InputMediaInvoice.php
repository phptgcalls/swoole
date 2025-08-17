<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string description invoice invoice bytes payload datajson provider_data inputwebdocument photo string provider string start_param inputmedia extended_media
 * @return InputMedia
 */

final class InputMediaInvoice extends Instance {
	public function request(string $title,string $description,object $invoice,string $payload,object $provider_data,? object $photo = null,? string $provider = null,? string $start_param = null,? object $extended_media = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x405fef0d);
		$flags = 0;
		$flags |= is_null($photo) ? 0 : (1 << 0);
		$flags |= is_null($provider) ? 0 : (1 << 3);
		$flags |= is_null($start_param) ? 0 : (1 << 1);
		$flags |= is_null($extended_media) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->write($invoice->read());
		$writer->tgwriteBytes($payload);
		if(is_null($provider) === false):
			$writer->tgwriteBytes($provider);
		endif;
		$writer->write($provider_data->read());
		if(is_null($start_param) === false):
			$writer->tgwriteBytes($start_param);
		endif;
		if(is_null($extended_media) === false):
			$writer->write($extended_media->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		$result['description'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		$result['invoice'] = $reader->tgreadObject();
		$result['payload'] = $reader->tgreadBytes();
		if($flags & (1 << 3)):
			$result['provider'] = $reader->tgreadBytes();
		else:
			$result['provider'] = null;
		endif;
		$result['provider_data'] = $reader->tgreadObject();
		if($flags & (1 << 1)):
			$result['start_param'] = $reader->tgreadBytes();
		else:
			$result['start_param'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['extended_media'] = $reader->tgreadObject();
		else:
			$result['extended_media'] = null;
		endif;
		return new self($result);
	}
}

?>
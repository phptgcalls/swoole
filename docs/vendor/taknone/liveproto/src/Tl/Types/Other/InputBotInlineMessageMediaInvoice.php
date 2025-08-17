<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title string description invoice invoice bytes payload string provider datajson provider_data inputwebdocument photo replymarkup reply_markup
 * @return InputBotInlineMessage
 */

final class InputBotInlineMessageMediaInvoice extends Instance {
	public function request(string $title,string $description,object $invoice,string $payload,string $provider,object $provider_data,? object $photo = null,? object $reply_markup = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd7e78225);
		$flags = 0;
		$flags |= is_null($photo) ? 0 : (1 << 0);
		$flags |= is_null($reply_markup) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($description);
		if(is_null($photo) === false):
			$writer->write($photo->read());
		endif;
		$writer->write($invoice->read());
		$writer->tgwriteBytes($payload);
		$writer->tgwriteBytes($provider);
		$writer->write($provider_data->read());
		if(is_null($reply_markup) === false):
			$writer->write($reply_markup->read());
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
		$result['provider'] = $reader->tgreadBytes();
		$result['provider_data'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['reply_markup'] = $reader->tgreadObject();
		else:
			$result['reply_markup'] = null;
		endif;
		return new self($result);
	}
}

?>
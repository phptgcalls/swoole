<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string status_text Vector<MessageEntity> status_entities Vector<string> video_sections Vector<Document> videos Vector<PremiumSubscriptionOption> period_options Vector<User> users
 * @return help.PremiumPromo
 */

final class PremiumPromo extends Instance {
	public function request(string $status_text,array $status_entities,array $video_sections,array $videos,array $period_options,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5334759c);
		$writer->tgwriteBytes($status_text);
		$writer->tgwriteVector($status_entities,'MessageEntity');
		$writer->tgwriteVector($video_sections,'string');
		$writer->tgwriteVector($videos,'Document');
		$writer->tgwriteVector($period_options,'PremiumSubscriptionOption');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['status_text'] = $reader->tgreadBytes();
		$result['status_entities'] = $reader->tgreadVector('MessageEntity');
		$result['video_sections'] = $reader->tgreadVector('string');
		$result['videos'] = $reader->tgreadVector('Document');
		$result['period_options'] = $reader->tgreadVector('PremiumSubscriptionOption');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>
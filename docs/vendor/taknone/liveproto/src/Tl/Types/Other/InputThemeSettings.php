<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param basetheme base_theme int accent_color true message_colors_animated int outbox_accent_color Vector<int> message_colors inputwallpaper wallpaper wallpapersettings wallpaper_settings
 * @return InputThemeSettings
 */

final class InputThemeSettings extends Instance {
	public function request(object $base_theme,int $accent_color,? true $message_colors_animated = null,? int $outbox_accent_color = null,? array $message_colors = null,? object $wallpaper = null,? object $wallpaper_settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8fde504f);
		$flags = 0;
		$flags |= is_null($message_colors_animated) ? 0 : (1 << 2);
		$flags |= is_null($outbox_accent_color) ? 0 : (1 << 3);
		$flags |= is_null($message_colors) ? 0 : (1 << 0);
		$flags |= is_null($wallpaper) ? 0 : (1 << 1);
		$flags |= is_null($wallpaper_settings) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($base_theme->read());
		$writer->writeInt($accent_color);
		if(is_null($outbox_accent_color) === false):
			$writer->writeInt($outbox_accent_color);
		endif;
		if(is_null($message_colors) === false):
			$writer->tgwriteVector($message_colors,'int');
		endif;
		if(is_null($wallpaper) === false):
			$writer->write($wallpaper->read());
		endif;
		if(is_null($wallpaper_settings) === false):
			$writer->write($wallpaper_settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['message_colors_animated'] = true;
		else:
			$result['message_colors_animated'] = false;
		endif;
		$result['base_theme'] = $reader->tgreadObject();
		$result['accent_color'] = $reader->readInt();
		if($flags & (1 << 3)):
			$result['outbox_accent_color'] = $reader->readInt();
		else:
			$result['outbox_accent_color'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['message_colors'] = $reader->tgreadVector('int');
		else:
			$result['message_colors'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['wallpaper'] = $reader->tgreadObject();
		else:
			$result['wallpaper'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['wallpaper_settings'] = $reader->tgreadObject();
		else:
			$result['wallpaper_settings'] = null;
		endif;
		return new self($result);
	}
}

?>